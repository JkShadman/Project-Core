<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\ChipController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/', fn()=> redirect()->route('players.index'));

Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');

Route::prefix('/team')->group(function(){
    Route::get('/', [TeamController::class, 'show'])->name('team.show');
    Route::get('/select', [TeamController::class, 'selectForm'])->name('team.select');
    Route::post('/save', [TeamController::class, 'saveSelection'])->name('team.save');
    Route::post('/captain', [TeamController::class, 'setCaptains'])->name('team.captain');
});

Route::prefix('/transfers')->group(function(){
    Route::get('/', [TransferController::class, 'index'])->name('transfers.index');
    Route::post('/swap', [TransferController::class, 'swap'])->name('transfers.swap');
});

Route::prefix('/chips')->group(function(){
    Route::get('/', [ChipController::class, 'index'])->name('chips.index');
    Route::post('/play', [ChipController::class, 'play'])->name('chips.play');
});

Route::prefix('/admin')->group(function(){
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/update-stats', [AdminController::class, 'updateStats'])->name('admin.update_stats');
});