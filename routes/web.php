<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VyberProduktovController;
use App\Http\Controllers\PrihlasenieController;
use App\Http\Controllers\RegistraciaController;
use App\Http\Controllers\ZabudnuteHesloController;
use App\Http\Controllers\KosikController;
use App\Http\Controllers\DetailProduktuController;
use App\Http\Controllers\PlatobnaBranaController;
use App\Http\Controllers\VytvorenieObjednavkyController;
use App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/kategorie', [VyberProduktovController::class, 'index'])->name('kategorie');
Route::get('/prihlasenie', [PrihlasenieController::class, 'index'])->name('prihlasenie');
Route::get('/registracia', [RegistraciaController::class, 'index'])->name('registracia');
Route::get('/zabudnute_heslo', [ZabudnuteHesloController::class, 'index'])->name('zabudnute_heslo');
Route::get('/kosik', [KosikController::class, 'index'])->name('kosik');
Route::get('/detail_produktu', [DetailProduktuController::class, 'index'])->name('detail_produktu');
Route::get('/platobna_brana', [PlatobnaBranaController::class, 'index'])->name('platobna_brana');
Route::get('/vytvorenie_objednavky', [VytvorenieObjednavkyController::class, 'index'])->name('vytvorenie_objednavky');
Route::get('/products', [ProductController::class, 'index']);
