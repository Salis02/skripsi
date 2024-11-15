<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\FuzzyRange;
use App\Models\InputFuzzy;
use Illuminate\Http\Request;
use App\Models\RekomendasiMatkul;
use Illuminate\Support\Facades\Auth;

class FuzzyCalculationController extends Controller
{
    public function index()
    {

        // Mengecek apakah tabel FuzzyRange memiliki data atau tidak
        $fuzzyRangeExists = FuzzyRange::exists();
        // Mengecek apakah terdapat data inference yang dibutuhkan (sesuaikan jika menggunakan tabel lain)
        $inferenceExists = method_exists($this, 'inference'); // Sesuaikan pengecekan inference yang relevan

        // Jika salah satu dari data fuzzy range atau inference tidak ada
        if (!$fuzzyRangeExists || !$inferenceExists) {
            return view('mahasiswa.menu', [
                'title' => 'Menu Rekomendasi',
                'active' => 'menu',
                'message' => 'Maaf, saat ini fitur tidak tersedia.',
            ]);
        }
        
        // Mengambil data mahasiswa yang terkait dengan user yang sedang login
        $mahasiswa = Auth::user()->mahasiswa;

        // Mengambil semua semester dari tabel semester
        $semesters = Semester::all();

        // Mengambil IPK sebelumnya dari method data()
        $indeksPrestasi = $this->getIndeksPrestasi();

        // Mengambil data mata kuliah dengan nilai di bawah C, termasuk informasi semester
        $nilaiDiBawahC = $mahasiswa->transkrip()
        ->where('nilai_akhir', '<', 5.0)  // Asumsikan nilai di bawah C adalah kurang dari 2.0
        ->with(['matkul' => function ($query) {
            $query->with('semester');  // Memuat relasi semester dari tabel matkul
        }])
        ->get();

        // Pisahkan berdasarkan ganjil dan genap
        $nilaiGanjil = $nilaiDiBawahC->filter(function ($item) {
            return $item->matkul->semester->semester % 2 != 0;  // Semester ganjil
        });

        $nilaiGenap = $nilaiDiBawahC->filter(function ($item) {
            return $item->matkul->semester->semester % 2 == 0;  // Semester genap
        });



        return view('mahasiswa.menu', [
            'title' => 'Menu Rekomendasi',
            'active' => 'menu',
            'mahasiswa' => $mahasiswa,
            'semesters' => $semesters,
            'indeksPrestasi' => $indeksPrestasi,
            'nilaiGanjil' => $nilaiGanjil,
            'nilaiGenap' => $nilaiGenap,
        ]);
    }

    // Method untuk menghitung IPK
    public function getIndeksPrestasi()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Ambil data menggunakan query builder
        // Menggunakan Eloquent dan relasi
        $transkrip = $mahasiswa->transkrip()->with('matkul')->get();

        $totalSks = 0;
        $totalNilaiSks = 0; // Untuk total nilai akhir dikalikan SKS

        // Loop melalui transkrip untuk menghitung total SKS dan total nilai akhir * SKS
        foreach ($transkrip as $item) {
            $sks = $item->matkul->totalSks;
            $nilaiAkhir = $item->nilai_akhir;

            // Hitung total SKS
            $totalSks += $sks;

            // Hitung total nilai akhir x SKS
            $totalNilaiSks += $nilaiAkhir ;
        }

        // Menghindari pembagian dengan nol dan menghitung IPK
        $indeksPrestasi = $totalSks ? $totalNilaiSks / $totalSks : 0;

        return number_format($indeksPrestasi, 2, '.','');
    }

    // public function fuzzifyVariableIPK($input, $variabel)
    // {
    //     // dd($input, $variabel);
    //     // Ambil rentang dari tabel fuzzyRange berdasarkan variabel
    //     // Ambil data dari database untuk variabel tertentu
    //     $ranges = FuzzyRange::where('variabel', $variabel)->get();

    //     // Inisialisasi array untuk menyimpan nilai keanggotaan fuzzy
    //     $membership = [];

    //     // Fuzzifikasi untuk IPK Sebelumnya
    //     if ($variabel === 'ipk_sebelumnya') {
    //         foreach ($ranges as $range) {
    //             // Dapatkan batas-batas untuk kategori (rendah, sedang, tinggi)
    //             $min = $range->min_value;
    //             $max = $range->max_value;

    //             if ($range->category === 'rendah' && $input <= $max) {
    //                 // Jika IPK <= 2.00, kategori rendah penuh
    //                 $membership['rendah'] = 1;
    //                 $membership['sedang'] = 0;
    //                 $membership['tinggi'] = 0;
    //             } elseif ($range->category === 'sedang' && $input > $min && $input < $max) {
    //                 // Jika IPK antara 2.00 dan 3.00, interpolasi antara rendah dan sedang
    //                 $membership['rendah'] = ($max - $input) / ($max - $min);
    //                 $membership['sedang'] = ($input - $min) / ($max - $min);
    //                 $membership['tinggi'] = 0;
    //             } elseif ($range->category === 'tinggi' && $input >= $min && $input <= $max) {
    //                 // Jika IPK antara 3.00 dan 4.00, interpolasi antara sedang dan tinggi
    //                 $membership['rendah'] = 0;
    //                 $membership['sedang'] = ($max - $input) / ($max - $min);
    //                 $membership['tinggi'] = ($input - $min) / ($max - $min);
    //             } elseif ($range->category === 'tinggi' && $input >= $max) {
    //                 // Jika IPK >= 4.00, kategori tinggi penuh
    //                 $membership['rendah'] = 0;
    //                 $membership['sedang'] = 0;
    //                 $membership['tinggi'] = 1;
    //             }
    //         }
    //     }

        
    //     // dd($membership);
    //     return $membership; // Kembalikan hasil keanggotaan untuk setiap kategori
    // }
  
    public function fuzzifyVariableIPK($input, $variabel) 
    {
        // Ambil rentang dari tabel fuzzyRange berdasarkan variabel
        $ranges = FuzzyRange::where('variabel', $variabel)->get();
    
        // Inisialisasi array untuk menyimpan nilai keanggotaan fuzzy
        $membership = [
            'rendah' => 0,
            'sedang' => 0,
            'tinggi' => 0
        ];
    
        // Ambil batas minimum dan maksimum untuk setiap kategori
        $rendah = $ranges->firstWhere('category', 'rendah');
        $sedang = $ranges->firstWhere('category', 'sedang');
        $tinggi = $ranges->firstWhere('category', 'tinggi');

        // dd($rendah, $sedang, $tinggi);
    
        // Pastikan batasan ada untuk setiap kategori
        if ($rendah && $sedang && $tinggi) {
            // Ambil batas min dan max untuk setiap kategori
            $minRendah = $rendah->min_value;
            $maxRendah = $rendah->max_value;
    
            $minSedang = $sedang->min_value;
            $maxSedang = $sedang->max_value;
    
            $minTinggi = $tinggi->min_value;
            $maxTinggi = $tinggi->max_value;
    
            // Fuzzifikasi untuk IPK Sebelumnya
            if ($input <= $maxRendah) {
                // Jika IPK <= max rendah, kategori rendah penuh
                $membership['rendah'] = 1;
            } elseif ($input > $minSedang && $input < $maxSedang) {
                // Jika IPK di antara min sedang dan max sedang, interpolasi antara rendah dan sedang
                $membership['rendah'] = ($maxSedang - $input) / ($maxSedang - $minSedang);
                $membership['sedang'] = ($input - $minSedang) / ($maxSedang - $minSedang);
            } elseif ($input >= $minTinggi && $input <= $maxTinggi) {
                // Jika IPK di antara min tinggi dan max tinggi, interpolasi antara sedang dan tinggi
                $membership['sedang'] = ($maxTinggi - $input) / ($maxTinggi - $minTinggi);
                $membership['tinggi'] = ($input - $minTinggi) / ($maxTinggi - $minTinggi);
            } elseif ($input >= $maxTinggi) {
                // Jika IPK >= max tinggi, kategori tinggi penuh
                $membership['tinggi'] = 1;
            }
        }
    
        return $membership; // Kembalikan hasil keanggotaan untuk setiap kategori
    }
    

    public function fuzzifyVariableMatkulMengulang($input, $variabel)
    {
        // dd($input, $variabel);
        // Ambil data dari database untuk variabel tertentu
        $ranges = FuzzyRange::where('variabel', $variabel)->get();

        // Inisialisasi array untuk menyimpan nilai keanggotaan fuzzy
        $membership = [];

       

        // Fuzzifikasi untuk Matkul Mengulang
        if ($variabel === 'matkul_mengulang') {
            foreach ($ranges as $range) {
                // Dapatkan batas-batas untuk kategori (sedikit, banyak)
                $min = $range->min_value;
                $max = $range->max_value;

                if ($range->category === 'sedikit' && $input <= $max) {
                    // Jika matkul mengulang <= 1, kategori sedikit penuh
                    $membership['sedikit'] = 1;
                    $membership['banyak'] = 0;
                } elseif ($range->category === 'banyak' && $input > $min && $input <= $max) {
                    // Jika matkul mengulang antara 1 dan 3, interpolasi antara sedikit dan banyak
                    $membership['sedikit'] = ($max - $input) / ($max - $min);
                    $membership['banyak'] = ($input - $min) / ($max - $min);
                } elseif ($range->category === 'banyak' && $input >= $max) {
                    // Jika matkul mengulang >= 3, kategori banyak penuh
                    $membership['sedikit'] = 0;
                    $membership['banyak'] = 1;
                }
            }
        }


        // dd($membership);
        return $membership; // Kembalikan hasil keanggotaan untuk setiap kategori
    }


    public function calculateFuzzification(Request $request)
    {
        $request->validate([
            'ipk_sebelumnya' => 'required|numeric|min:0|max:4', // IPK antara 0.00 - 4.00
            'matkul_mengulang' => 'required|numeric|min:0',      // Matkul mengulang minimal 0
            'peminatan' => 'required|string',                    // Validasi untuk peminatan
        ]);
        
        $mahasiswa = Auth::user()->mahasiswa;

        // Mengambil IPK sebelumnya dari method data()
        $indeksPrestasi = $this->getIndeksPrestasi();

        // dd($request);

        $mahasiswa_id = $request->mahasiswa;
        $semester_id = $request->semester;
        $ipk = $request->ipk_sebelumnya;  // Nilai IPK sebelumnya
        $matkul_mengulang = $request->matkul_mengulang; // Ambil input dari form
        $peminatan = $request->peminatan;  // Pilihan peminatan

         // Tambahkan 1 ke semester_id untuk pencocokan
        $semester_target = $semester_id + 1; // Ini akan menjadi semester yang akan digunakan

        // Step 2: Proses fuzzifikasi untuk setiap variabel
        $fuzzy_ipk = $this->fuzzifyVariableIPK($ipk, 'ipk_sebelumnya');
        $fuzzy_matkul = $this->fuzzifyVariableMatkulMengulang($matkul_mengulang, 'matkul_mengulang');

        // dd($fuzzy_ipk, $fuzzy_matkul);

        // Step 3: Lakukan inferensi berdasarkan hasil fuzzifikasi
        $inference_results = $this->inference($fuzzy_ipk, $fuzzy_matkul);

        // dd($inference_results);

        // Step 4: Lakukan defuzzifikasi untuk mendapatkan hasil SKS tegas
        $recommended_sks = $this->defuzzification($inference_results);

        // dd($recommended_sks);

        // Step 5: Ambil rekomendasi mata kuliah berdasarkan semester berikutnya
        $rekomendasi_matkul = $this->getRekomendasiMatkulBySemester($semester_target);

        // dd($rekomendasi_matkul);
        
        // Simpan paket rekomendasi sebagai JSON
        $paket_rekomendasi_json = json_encode($rekomendasi_matkul);
       

        // Step 6: Simpan hasil ke dalam tabel inputfuzzy
        $inputFuzzy = InputFuzzy::create([
            'mahasiswa_id' => $mahasiswa->id,
            'semester_id' => $semester_id,
            'ipk_sebelumnya' => $ipk,
            'matkul_mengulang' => $matkul_mengulang,
            'peminatan' => $peminatan,
            'hasil_defuzzifikasi' => $recommended_sks,
            'paket_rekomendasi' => $paket_rekomendasi_json,
        ]);

        // dd($inputFuzzy);

        // Step 7: Simpan data rekomendasi mata kuliah ke tabel rekomendasi_matkul
        foreach ($rekomendasi_matkul as $matkul) {
            RekomendasiMatkul::create([
                'type' => $peminatan,  // Anda bisa mengatur tipe sesuai kebutuhan
                'matkul_id' => $matkul->id, // ID mata kuliah yang direkomendasikan
                'inputfuzzy_id' => $inputFuzzy->id,  // Menyimpan relasi ke InputFuzzy yang baru
            ]);
        }

        // Mengambil data mata kuliah dengan nilai di bawah C, termasuk informasi semester
        $nilaiDiBawahC = $mahasiswa->transkrip()
        ->where('nilai_akhir', '<', 5.0)  // Asumsikan nilai di bawah C adalah kurang dari 2.0
        ->with(['matkul' => function ($query) {
            $query->with('semester');  // Memuat relasi semester dari tabel matkul
        }])
        ->get();

        // Pisahkan berdasarkan ganjil dan genap
        $nilaiGanjil = $nilaiDiBawahC->filter(function ($item) {
            return $item->matkul->semester->semester % 2 != 0;  // Semester ganjil
        });

        $nilaiGenap = $nilaiDiBawahC->filter(function ($item) {
            return $item->matkul->semester->semester % 2 == 0;  // Semester genap
        });



        // Step 7: Kembalikan hasil perhitungan fuzzy ke view
        return view('mahasiswa.menu', [
            'title' => 'Menu Rekomendasi',
            'active' => 'menu',
            'mahasiswa' => $mahasiswa,
            'semesters' => Semester::all(),  // Data semester untuk form
            'indeksPrestasi' => $indeksPrestasi,
            'recommended_sks' => $recommended_sks,  // Hasil SKS dari fuzzy
            'rekomendasi_matkul' => $rekomendasi_matkul, // Tambahkan data rekomendasi mata kuliah
            'paket_rekomendasi' => $paket_rekomendasi_json,
            'semester_target' => $semester_target,
            'nilaiGanjil' => $nilaiGanjil,
            'nilaiGenap' => $nilaiGenap,
        ]);
    }

    public function inference($fuzzy_ipk, $fuzzy_matkul)
    {
        // Ambil aturan inferensi dari tabel inference_rules di database
        $rules = \DB::table('inference_rules')->get();

        $inference_results = [];

        // Loop melalui setiap aturan dan hitung derajat keanggotaan (α)
        foreach ($rules as $rule) {
            if (isset($fuzzy_ipk[$rule->ipk_category]) && isset($fuzzy_matkul[$rule->matkul_category])) {
                $ipk_value = $fuzzy_ipk[$rule->ipk_category];
                $matkul_value = $fuzzy_matkul[$rule->matkul_category];

                // Operasi AND (ambil nilai minimum dari fuzzy IPK dan Matkul)
                $alpha = min($ipk_value, $matkul_value);
                $inference_results[] = ['rule' => $rule, 'alpha' => $alpha];
            }
        }

        // Kembalikan hasil inferensi untuk digunakan di tahap defuzzifikasi
        return $inference_results;
    }

    public function defuzzification($inference_results)
    {
        // dd($inference_results);

        $numerator = 0;  // Untuk menyimpan hasil perkalian α * Z
        $denominator = 0;  // Untuk menyimpan total α

         // Loop melalui setiap hasil inferensi
        foreach ($inference_results as $result) {
            $alpha = $result['alpha'];  // Ambil nilai keanggotaan α
            $min_sks = $result['rule']->min_sks;  // Ambil nilai minimum SKS dari aturan
            $max_sks = $result['rule']->max_sks;  // Ambil nilai maksimum SKS dari aturan

            // Hanya proses aturan dengan alpha > 0
            if ($alpha > 0) {
                // Jika α = 1, langsung gunakan nilai maksimum dari rentang SKS
                if ($alpha == 1) {
                    return $max_sks;  // Kembalikan nilai maksimum rentang sebagai hasil defuzzifikasi
                }
                
                // Jika α < 1, gunakan nilai tengah dari rentang SKS
                $z_value = ($min_sks + $max_sks) / 2;  // Gunakan nilai tengah dari rentang SKS

                // Hitung numerator dan denominator
                $numerator += $alpha * $z_value;
                $denominator += $alpha;
            }
        }

        // Hitung output tegas (Z total)
        $z_total = ($denominator != 0) ? $numerator / $denominator : 0;

        // dd($z_total);

        return round($z_total); // Kembalikan hasil SKS sebagai angka bulat
    }

    public function getRekomendasiMatkulBySemester($semester_target)
    {
        // Mendapatkan rekomendasi matkul berdasarkan semester target dan hanya matkul ber-type 'wajib'
        $rekomendasi = \DB::table('matkul')
        ->join('typematkul', 'matkul.typeid', '=', 'typematkul.id')
        ->select('matkul.*', 'typematkul.sifat')
        ->where('typematkul.sifat', 'wajib') // Hanya matkul yang memiliki sifat 'wajib'
        ->where('matkul.semesterId', $semester_target)
        ->get();

        return $rekomendasi;
    }



    //Method Riwayat Rekomendasi
    public function riwayat()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Ambil semua riwayat rekomendasi dari tabel inputFuzzy
        $riwayatRekomendasi = InputFuzzy::where('mahasiswa_id', $mahasiswa->id)->get();

        // Loop melalui setiap riwayat untuk decode paket rekomendasi dari JSON
        foreach ($riwayatRekomendasi as $riwayat) {
            $riwayat->paket_rekomendasi = json_decode($riwayat->paket_rekomendasi);
        }

        return view('mahasiswa.riwayat', [
            'title' => 'Riwayat Rekomendasi',
            'active' => 'riwayat',
            'mahasiswa' => $mahasiswa,
            'riwayatRekomendasi' => $riwayatRekomendasi,
        ]);
    }
    
    public function hapusRiwayat($id)
    {
        // Ambil data input fuzzy berdasarkan ID dan hapus
        $inputFuzzy = InputFuzzy::findOrFail($id);
        $inputFuzzy->delete();

        // Redirect kembali ke halaman riwayat dengan pesan sukses
        return redirect()->route('riwayat')->with('success', 'Riwayat berhasil dihapus.');
    }


}