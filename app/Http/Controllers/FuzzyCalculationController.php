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

    public function fuzzifyVariable($input, $variable)
    {

        // dd($input, $variable);
        // Ambil rentang dari tabel fuzzyRange berdasarkan variabel
        $ranges = FuzzyRange::where('variable', $variable)->get();

        // Validasi input (misalnya, IPK tidak mungkin lebih dari 4.0)
        if ($variable == 'IPK' && ($input < 0 || $input > 4)) {
            dd('Input IPK tidak valid: ' . $input);
        }

        // Ambil rentang dari tabel fuzzyRange berdasarkan variabel
        $ranges = FuzzyRange::where('variable', $variable)->get();

        if ($ranges->isEmpty()) {
            dd('No ranges found for variable: ' . $variable);
        }


        // Inisialisasi array untuk menyimpan nilai keanggotaan fuzzy
        $membership = [];

        // Kondisi khusus untuk matkul mengulang
    if ($variable === 'matkul_mengulang') {
        // Debugging untuk memeriksa apakah kondisi ini terpenuhi
        // dd('Proses matkul mengulang dimulai', $input, $variable);

        // Jika matkul mengulang adalah 0, dianggap sebagai "Sedikit"
        if ($input == 0) {
            foreach ($ranges as $range) {
                if ($range->category === 'Sedikit') {
                    $membership[$range->category] = 1;
                } else {
                    $membership[$range->category] = 0;
                }
            }
            return $membership;
        }

        // Jika matkul mengulang > 0, lakukan fuzzifikasi normal
        foreach ($ranges as $range) {
            if ($input <= $range->min_value) {
                $membership[$range->category] = 0;
            } elseif ($input >= $range->max_value) {
                $membership[$range->category] = 1;
            } else {
                // Menggunakan interpolasi linier
                $membership[$range->category] = ($input - $range->min_value) / ($range->max_value - $range->min_value);
            }
        }

        return $membership;
    }
        // Fuzzifikasi normal
        foreach ($ranges as $range) {
            if ($input <= $range->min_value) {
                $membership[$range->category] = 0; // Di luar rentang bawah
            } elseif ($input >= $range->max_value) {
                $membership[$range->category] = 1; // Di luar rentang atas
            } else {
                // Menggunakan interpolasi linier untuk menentukan nilai keanggotaan fuzzy
                $membership[$range->category] = ($input - $range->min_value) / ($range->max_value - $range->min_value);
            }
        }

    return $membership; // Kembalikan hasil keanggotaan untuk setiap kategori
    }

    public function calculateFuzzification(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $semester_id = $request->semester;
        $ipk = $request->ipk_sebelumnya;  // Nilai IPK sebelumnya
        $matkul_mengulang = $request->matkul_mengulang; // Ambil input dari form
        $peminatan = $request->peminatan;  // Pilihan peminatan

         // Tambahkan 1 ke semester_id untuk pencocokan
        $semester_target = $semester_id + 1; // Ini akan menjadi semester yang akan digunakan

        // Step 2: Proses fuzzifikasi untuk setiap variabel
        $fuzzy_ipk = $this->fuzzifyVariable($ipk, 'ipk_sebelumnya');
        $fuzzy_matkul = $this->fuzzifyVariable($matkul_mengulang, 'matkul_mengulang');


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
        $rekomendasi_matkul = $this->getRekomendasiMatkul($semester_target, $peminatan);

        // Step 6: Kembalikan hasil perhitungan fuzzy ke view
        return view('mahasiswa.menu', [
            'title' => 'Menu Rekomendasi',
            'active' => 'menu',
            'mahasiswa' => $mahasiswa,
            'semesters' => Semester::all(),  // Data semester untuk form
            'indeksPrestasi' => $this->getIndeksPrestasi(),  // IPK yang dihitung
            'recommended_sks' => $recommended_sks,  // Hasil SKS dari fuzzy
            'rekomendasi_matkul' => $rekomendasi_matkul, // Tambahkan data rekomendasi mata kuliah
        ]);
    }

    public function inference($fuzzy_ipk, $fuzzy_matkul)
    {
        // Menyimpan aturan inferensi dalam array
        $rules = [
            ['ipk' => 'Tinggi', 'matkul' => 'Sedikit', 'sks' => 'Banyak'],
            ['ipk' => 'Tinggi', 'matkul' => 'Banyak', 'sks' => 'Banyak'],
            ['ipk' => 'Sedang', 'matkul' => 'Sedikit', 'sks' => 'Agak Banyak'],
            ['ipk' => 'Sedang', 'matkul' => 'Banyak', 'sks' => 'Agak Banyak'],
            ['ipk' => 'Rendah', 'matkul' => 'Sedikit', 'sks' => 'Agak Sedikit'],
            ['ipk' => 'Rendah', 'matkul' => 'Banyak', 'sks' => 'Sedikit'],
        ];

        $inference_results = [];

        // Evaluasi setiap aturan dan hitung derajat keanggotaan (α)
        foreach ($rules as $rule) {
            $ipk_value = $fuzzy_ipk[$rule['ipk']];
            $matkul_value = $fuzzy_matkul[$rule['matkul']];

            // Operasi AND (ambil nilai minimum dari fuzzy IPK dan Matkul)
            $alpha = min($ipk_value, $matkul_value);
            $inference_results[] = ['rule' => $rule, 'alpha' => $alpha];
        }

        // Kembalikan hasil inferensi untuk digunakan di tahap defuzzifikasi
        return $inference_results;
    }

    public function defuzzification($inference_results)
    {
        $numerator = 0;  // Untuk menyimpan hasil perkalian α * Z
        $denominator = 0;  // Untuk menyimpan total α

        // Mendefinisikan nilai Z untuk setiap kategori SKS
        $sks_values = [
            'Sedikit' => [15, 17],
            'Agak Sedikit' => [17, 20],
            'Agak Banyak' => [20, 22],
            'Banyak' => [22, 24],
        ];

        // Loop melalui setiap hasil inferensi untuk menghitung defuzzifikasi
        foreach ($inference_results as $result) {
            $alpha = $result['alpha'];
            $sks_category = $result['rule']['sks'];

            // Ambil nilai tengah dari rentang SKS yang sesuai
            $z_value = ($sks_values[$sks_category][0] + $sks_values[$sks_category][1]) / 2;

            // Hitung bagian dari numerik dan denominasi
            $numerator += $alpha * $z_value;
            $denominator += $alpha;
        }

        // Menghitung output tegas (Z total)
        $z_total = ($denominator != 0) ? $numerator / $denominator : 0;

        return round($z_total + 1.5); // Kembalikan hasil perhitungan SKS
    }

    public function getRekomendasiMatkul($semester, $peminatan)
    {
        // Ambil data dari tabel rekomendasi_matkul berdasarkan semester dan type
        $rekomendasi = [];

        // Cek untuk semester wajib (tambahan 1)
        $rekomendasi_wajib = RekomendasiMatkul::where('type', 'wajib')
            ->join('matkul', 'rekomendasi_matkul.matkul_id', '=', 'matkul.id') // Join dengan tabel matkul
            ->where('matkul.semesterId', $semester) // Filter berdasarkan semester
            ->select('rekomendasi_matkul.*') // Ambil semua kolom dari rekomendasi_matkul
            ->get();

        $rekomendasi = $rekomendasi_wajib;

        // Cek untuk semester pilihan
        if ($semester >= 4) {
            // Cek apakah ada nilai C atau dibawahnya di transkrip
            $mahasiswa = Auth::user()->mahasiswa;
            $transkrip = $mahasiswa->transkrip()->with('matkul')->get();

            $has_c_grade = $transkrip->contains(function ($item) {
                return $item->nilai_akhir < 2.0; // Asumsikan C adalah 2.0
            });

            if ($has_c_grade) {
                // Ambil mata kuliah pilihan jika ada nilai C
                $rekomendasi_pilihan = RekomendasiMatkul::where('type', 'pilihan')
                    ->join('matkul', 'rekomendasi_matkul.matkul_id', '=', 'matkul.id') // Join dengan tabel matkul
                    ->where('matkul.semester', $semester) // Filter berdasarkan semester
                    ->select('rekomendasi_matkul.*') // Ambil semua kolom dari rekomendasi_matkul
                    ->get();

                $rekomendasi = $rekomendasi_wajib->merge($rekomendasi_pilihan);
            }
        }

        return $rekomendasi; // Kembalikan data rekomendasi
    }



}


