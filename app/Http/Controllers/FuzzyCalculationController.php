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
        // Mengambil data mahasiswa yang terkait dengan user yang sedang login
        $mahasiswa = Auth::user()->mahasiswa;

        // Mengambil semua semester dari tabel semester
        $semesters = Semester::all();

        // Mengambil IPK sebelumnya dari method data()
        $indeksPrestasi = $this->getIndeksPrestasi();

        return view('mahasiswa.menu', [
            'title' => 'Menu Rekomendasi',
            'active' => 'menu',
            'mahasiswa' => $mahasiswa,
            'semesters' => $semesters,
            'indeksPrestasi' => $indeksPrestasi,
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

    public function fuzzifyVariable($input, $variabel)
    {
        // dd($input, $variabel);
        // Ambil rentang dari tabel fuzzyRange berdasarkan variabel
        $ranges = FuzzyRange::where('variabel', $variabel)->get();

        // dd($ranges);
        // Inisialisasi array untuk menyimpan nilai keanggotaan fuzzy
        $membership = [];

        // Fuzzifikasi untuk IPK
        if ($variabel === 'ipk_sebelumnya') {
            if ($input <= 2.00) {
                // Jika IPK di bawah atau sama dengan 2.00, maka masuk ke kategori rendah penuh
                $membership['rendah'] = 1;
                $membership['sedang'] = 0;
                $membership['tinggi'] = 0;
            } elseif ($input > 2.00 && $input < 3.00) {
                // Jika IPK di antara 2.00 dan 3.00, interpolasi antara rendah dan sedang
                $membership['rendah'] = (3.00 - $input) / (3.00 - 2.00);
                $membership['sedang'] = ($input - 2.00) / (3.00 - 2.00);
                $membership['tinggi'] = 0;
            } elseif ($input >= 3.00 && $input < 4.00) {
                // Jika IPK di antara 3.00 dan 4.00, interpolasi antara sedang dan tinggi
                $membership['rendah'] = 0;
                $membership['sedang'] = (4.00 - $input) / (4.00 - 3.00);
                $membership['tinggi'] = ($input - 3.00) / (4.00 - 3.00);
            } else {
                // Jika IPK >= 4.00, maka masuk ke kategori tinggi penuh
                $membership['rendah'] = 0;
                $membership['sedang'] = 0;
                $membership['tinggi'] = 1;
            }
        }

        // Fuzzifikasi untuk Matkul Mengulang
        if ($variabel === 'matkul_mengulang') {
            if ($input <= 1) {
                // Jika matkul mengulang <= 1, maka masuk ke kategori sedikit penuh
                $membership['sedikit'] = 1;
                $membership['banyak'] = 0;
            } elseif ($input > 1 && $input <= 3) {
                // Jika matkul mengulang antara 1 dan 3, interpolasi antara sedikit dan banyak
                $membership['sedikit'] = (3 - $input) / (3 - 1);
                $membership['banyak'] = ($input - 1) / (3 - 1);
            } else {
                // Jika matkul mengulang >= 3, maka masuk ke kategori banyak penuh
                $membership['sedikit'] = 0;
                $membership['banyak'] = 1;
            }
        }

        // dd($membership);
        return $membership; // Kembalikan hasil keanggotaan untuk setiap kategori
    }


    public function calculateFuzzification(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // dd($request);

        $semester_id = $request->semester;
        $ipk = $request->ipk_sebelumnya;  // Nilai IPK sebelumnya
        $matkul_mengulang = $request->matkul_mengulang; // Ambil input dari form
        $peminatan = $request->peminatan;  // Pilihan peminatan

         // Tambahkan 1 ke semester_id untuk pencocokan
        $semester_target = $semester_id + 1; // Ini akan menjadi semester yang akan digunakan

        // Step 2: Proses fuzzifikasi untuk setiap variabel
        $fuzzy_ipk = $this->fuzzifyVariable($ipk, 'ipk_sebelumnya');
        $fuzzy_matkul = $this->fuzzifyVariable($matkul_mengulang, 'matkul_mengulang');

        // dd($fuzzy_ipk, $fuzzy_matkul);

        // Step 3: Lakukan inferensi berdasarkan hasil fuzzifikasi
        $inference_results = $this->inference($fuzzy_ipk, $fuzzy_matkul);

        // Step 4: Lakukan defuzzifikasi untuk mendapatkan hasil SKS tegas
        $recommended_sks = $this->defuzzification($inference_results);

        // Step 5: Simpan hasil ke dalam tabel `inputfuzzy`
        InputFuzzy::create([
            'semester_id' => $semester_id,
            'ipk_sebelumnya' => $ipk,
            'matkul_mengulang' => $matkul_mengulang,
            'peminatan' => $peminatan,
            'hasil_defuzzifikasi' => $recommended_sks,
        ]);

        // Memanggil method baru untuk mengambil rekomendasi mata kuliah
        // $rekomendasi_matkul = $this->getRekomendasiMatkul($semester_target, $peminatan);

        // Step 6: Kembalikan hasil perhitungan fuzzy ke view
        return view('mahasiswa.menu', [
            'title' => 'Menu Rekomendasi',
            'active' => 'menu',
            'mahasiswa' => $mahasiswa,
            'semesters' => Semester::all(),  // Data semester untuk form
            'indeksPrestasi' => $this->getIndeksPrestasi(),  // IPK yang dihitung
            'recommended_sks' => $recommended_sks,  // Hasil SKS dari fuzzy
            // 'rekomendasi_matkul' => $rekomendasi_matkul, // Tambahkan data rekomendasi mata kuliah
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
                $z_value = ($min_sks + $max_sks) / 2;  // Gunakan nilai tengah dari rentang SKS

                // Hitung numerator dan denominator
                $numerator += $alpha * $z_value;
                $denominator += $alpha;
            }
        }

        // Hitung output tegas (Z total)
        $z_total = ($denominator != 0) ? $numerator / $denominator : 0;

        // dd($z_total);
        return round($z_total * 1.05); // Kembalikan hasil SKS sebagai angka bulat
    }

    // public function getRekomendasiMatkul($semester, $peminatan)
    // {
    //     // Ambil data dari tabel rekomendasi_matkul berdasarkan semester dan type
    //     $rekomendasi = [];

    //     // Cek untuk semester wajib (tambahan 1)
    //     $rekomendasi_wajib = RekomendasiMatkul::where('type', 'wajib')
    //         ->join('matkul', 'rekomendasi_matkul.matkul_id', '=', 'matkul.id') // Join dengan tabel matkul
    //         ->where('matkul.semesterId', $semester) // Filter berdasarkan semester
    //         ->select('rekomendasi_matkul.*') // Ambil semua kolom dari rekomendasi_matkul
    //         ->get();

    //     $rekomendasi = $rekomendasi_wajib;

    //     // Cek untuk semester pilihan
    //     if ($semester >= 4) {
    //         // Cek apakah ada nilai C atau dibawahnya di transkrip
    //         $mahasiswa = Auth::user()->mahasiswa;
    //         $transkrip = $mahasiswa->transkrip()->with('matkul')->get();

    //         $has_c_grade = $transkrip->contains(function ($item) {
    //             return $item->nilai_akhir < 2.0; // Asumsikan C adalah 2.0
    //         });

    //         if ($has_c_grade) {
    //             // Ambil mata kuliah pilihan jika ada nilai C
    //             $rekomendasi_pilihan = RekomendasiMatkul::where('type', 'pilihan')
    //                 ->join('matkul', 'rekomendasi_matkul.matkul_id', '=', 'matkul.id') // Join dengan tabel matkul
    //                 ->where('matkul.semester', $semester) // Filter berdasarkan semester
    //                 ->select('rekomendasi_matkul.*') // Ambil semua kolom dari rekomendasi_matkul
    //                 ->get();

    //             $rekomendasi = $rekomendasi_wajib->merge($rekomendasi_pilihan);
    //         }
    //     }

    //     return $rekomendasi; // Kembalikan data rekomendasi
    // }



}


