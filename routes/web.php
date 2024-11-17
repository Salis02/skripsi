<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TranskripController;
use App\Http\Controllers\FuzzyRangeController;
use App\Http\Controllers\FuzzyCalculationController;
use App\Http\Controllers\RekomendasiMatkulController;
use App\Http\Controllers\InferenceRuleController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {

    //Kelola User
        //Admin
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/admin/create', [AdminController::class, 'createAdmin']);
        Route::post('/admin/admin', [AdminController::class, 'storeAdmin']);
        Route::get('/admin/admin/{admin}/edit', [AdminController::class, 'editAdmin'])->name('admin.editAdmin');
        Route::put('/admin/admin/{admin}', [AdminController::class, 'updateAdmin']);

        //Dosen
        Route::get('/admin/dosen/create', [AdminController::class, 'createDosen']);
        Route::post('/admin/dosen', [AdminController::class, 'storeDosen']);
        Route::get('/admin/dosen/{dosen}/edit', [AdminController::class, 'editDosen']);
        Route::put('/admin/dosen/{dosen}', [AdminController::class, 'updateDosen']);
        Route::delete('/admin/dosen/{dosen}', [AdminController::class, 'destroyDosen']);

        //Mahasiswa
        Route::get('/admin/mahasiswa/create',
        [AdminController::class, 'createMahasiswa']);
        Route::post('/admin/mahasiswa', [AdminController::class, 'storeMahasiswa'])->name('admin.mahasiswa.store');
        Route::get('/admin/mahasiswa/{mahasiswa}/edit', [AdminController::class, 'editMahasiswa']);
        Route::put('/admin/mahasiswa/{mahasiswa}', [AdminController::class, 'updateMahasiswa']);
        Route::delete('/admin/mahasiswa/{mahasiswa}', [AdminController::class, 'destroyMahasiswa']);
        Route::get('/admin', function () {
            return redirect()->route('admin.dashboard');
        });

    //Kelola Matkul
    Route::resource('/admin/matkul', MatkulController::class);
    Route::get('/admin/matkul/{semesterId}', function($semesterId) {
        return Matkul::where('semester_id', $semesterId)->get();
    });

    //Kelola Transkrip Nilai
    Route::resource('/admin/transkrip', TranskripController::class);
    Route::post('/admin/transkrip/store-batch', [TranskripController::class, 'storeBatch'])->name('transkrip.storeBatch');

    //Kelola Variabel Tetap Fuzzy
    Route::resource('/admin/fuzzyRange', FuzzyRangeController::class);

    //Kelola Rules
    Route::resource('/admin/inference_rule', InferenceRuleController::class);

});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
    Route::get('/dosen/transkrip/{mahasiswa}', [DosenController::class, 'transkrip'])->name('dosen.transkrip');
    Route::get('/dosen', function () {
        return redirect()->route('dosen.dashboard');
    });

    Route::get('/dosen/fuzzyRange', [FuzzyRangeController::class, 'showDosen'])->name('fuzzyRange.dosen.index');
    Route::get('/dosen/inference_rule', [InferenceRuleController::class, 'showDosen'])->name('inference_rule.dosen.index');

    //Kelola Paket Rekomendasi
    Route::resource('/dosen/rekomendasi_matkul', RekomendasiMatkulController::class);

});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('dashboard.index');

    //Route untuk menampilkan data detail dari mahasiswa yang sedang login
    Route::get('/mahasiswa/data', [MahasiswaController::class, 'data'])->name('data');

    //Route untuk menampilkan view form menu rekomendasi Fuzzy
    Route::get('/mahasiswa/menu', [FuzzyCalculationController::class, 'index'])->name('menu');

    // Route untuk menghitung fuzzy
    Route::post('/mahasiswa/menu/calculate', [FuzzyCalculationController::class, 'calculateFuzzification'])->name('calculate.fuzzification');

    //Route untuk mengakses riwayat hasil fuzzy untuk KRS dan paket rekomendasi KRS
    Route::get('/mahasiswa/riwayat', [FuzzyCalculationController::class, 'riwayat'])->name('riwayat');
    Route::delete('/mahasiswa/riwayat/{id}', [FuzzyCalculationController::class, 'hapusRiwayat'])->name('riwayat.hapus');

    Route::get('/mahasiswa/rekomendasi/{inputFuzzyId}', [FuzzyCalculationController::class, 'rekomendasiMatkul'])->name('rekomendasi.matkul');


});

Route::get('/', function () {
    return view('welcome');
});
