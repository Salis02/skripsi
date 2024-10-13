<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FuzzyTsukamotoService
{
    private $ipkRanges;
    private $matkulRanges;

    public function __construct()
    {
        $this->ipkRanges = $this->getRanges('ipk_sebelumnya');
        $this->matkulRanges = $this->getRanges('matkul_mengulang');
    }

    private function getRanges($variable)
    {
        $ranges = DB::table('fuzzyrange')
        ->where('variable', $variable)
        ->get()
        ->keyBy('category')
        ->map(function ($item) {
            return [
                'min' => $item->min_value,
                'max' => $item->max_value
            ];
        })
        ->toArray();

    // Pastikan kategori 'rendah', 'sedang', 'tinggi' ada
    $defaultRange = ['min' => 0, 'max' => 0];
    return [
        'rendah' => $ranges['rendah'] ?? $defaultRange,
        'sedang' => $ranges['sedang'] ?? $defaultRange,
        'tinggi' => $ranges['tinggi'] ?? $defaultRange
    ];
    }

    public function hitungRekomendasi($ipkSebelumnya, $matkulDibawahC)
    {
        $ipkFuzzy = $this->fuzzifikasiIPK($ipkSebelumnya);
        $matkulFuzzy = $this->fuzzifikasiMatkul($matkulDibawahC);

        $inferensi = $this->inferensi($ipkFuzzy, $matkulFuzzy);

        $sksRekomendasi = $this->defuzzifikasi($inferensi);

        return [
            'fuzzifikasi_ipk' => $ipkFuzzy,
            'fuzzifikasi_matkul' => $matkulFuzzy,
            'inferensi' => $inferensi,
            'defuzzifikasi' => $sksRekomendasi
        ];
    }

    private function fuzzifikasiIPK($ipk)
    {
        $rendah = $this->calculateMembership($ipk, $this->ipkRanges['rendah']);
        $sedang = $this->calculateMembership($ipk, $this->ipkRanges['sedang']);
        $tinggi = $this->calculateMembership($ipk, $this->ipkRanges['tinggi']);

        return [
            'rendah' => $rendah,
            'sedang' => $sedang,
            'tinggi' => $tinggi
        ];
    }

    private function fuzzifikasiMatkul($jumlahMatkul)
    {
        $sedikit = $this->calculateMembership($jumlahMatkul, $this->matkulRanges['sedikit']);
        $banyak = $this->calculateMembership($jumlahMatkul, $this->matkulRanges['banyak']);

        return [
            'sedikit' => $sedikit,
            'banyak' => $banyak
        ];
    }

    private function calculateMembership($value, $range)
    {
        if ($value <= $range['min']) return 1;
        if ($value >= $range['max']) return 0;
        return ($range['max'] - $value) / ($range['max'] - $range['min']);
    }

    private function inferensi($ipkFuzzy, $matkulFuzzy)
    {
        $rules = [
            ['ipk' => 'tinggi', 'matkul' => 'sedikit', 'sks' => 'banyak', 'nilai' => 23],
            ['ipk' => 'tinggi', 'matkul' => 'banyak', 'sks' => 'banyak', 'nilai' => 22],
            ['ipk' => 'sedang', 'matkul' => 'sedikit', 'sks' => 'agak_banyak', 'nilai' => 19],
            ['ipk' => 'sedang', 'matkul' => 'banyak', 'sks' => 'agak_banyak', 'nilai' => 21],
            ['ipk' => 'rendah', 'matkul' => 'sedikit', 'sks' => 'agak_sedikit', 'nilai' => 17],
            ['ipk' => 'rendah', 'matkul' => 'banyak', 'sks' => 'sedikit', 'nilai' => 17]
        ];

        $hasil = [];
        foreach ($rules as $rule) {
            $alpha = min($ipkFuzzy[$rule['ipk']], $matkulFuzzy[$rule['matkul']]);
            $hasil[] = [
                'rule' => $rule,
                'alpha' => $alpha,
                'nilai' => $rule['nilai']
            ];
        }

        return $hasil;
    }

    private function defuzzifikasi($inferensi)
    {
        $totalAlphaNilai = 0;
        $totalAlpha = 0;

        foreach ($inferensi as $hasil) {
            $totalAlphaNilai += $hasil['alpha'] * $hasil['nilai'];
            $totalAlpha += $hasil['alpha'];
        }

        if ($totalAlpha == 0) {
            return 0; // atau nilai default lainnya
        }

        return $totalAlphaNilai / $totalAlpha;
    }
}
