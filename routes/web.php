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
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\UserData;
use App\Http\Controllers\AdminController;   

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/kategorie', [VyberProduktovController::class, 'index'])->name('kategorie');
Route::get('/prihlasenie', [PrihlasenieController::class, 'index'])->name('prihlasenie');
Route::get('/registracia', [RegistraciaController::class, 'index'])->name('registracia');
Route::get('/zabudnute_heslo', [ZabudnuteHesloController::class, 'index'])->name('zabudnute_heslo');
//Route::get('/kosik', [KosikController::class, 'index'])->name('kosik');
Route::get('/detail_produktu/{id}', [DetailProduktuController::class, 'index'])->name('detail_produktu');
Route::get('/platobna_brana', [PlatobnaBranaController::class, 'index'])->name('platobna_brana');
Route::get('/vytvorenie_objednavky', [VytvorenieObjednavkyController::class, 'index'])->name('vytvorenie_objednavky');
//Route::post('/vytvorenie_objednavky', [VytvorenieObjednavkyController::class, 'store'])->name('vytvorenie_objednavky.store');
Route::post('/vytvorenie-objednavky/validate', [VytvorenieObjednavkyController::class, 'validateOrder'])->name('vytvorenie_objednavky.validate');
Route::get('/products', [ProductController::class, 'index']);

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart.index');
Route::get('/cart/proceed', [ShoppingCartController::class, 'proceedToOrder'])->name('cart.proceed');
Route::get('/user_data',[UserData::class, 'index'])->name('user_data');
Route::post('/cart/add', [ShoppingCartController::class, 'add'])->name('cart.add');
Route::post('/register', [RegistraciaController::class, 'register'])->name('register');
Route::post('/logout', [PrihlasenieController::class, 'logout'])->name('logout');
Route::post('/prihlasenie', [PrihlasenieController::class, 'login'])->name('login');
Route::put('/cart/{item}', [ShoppingCartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{productId}', [ShoppingCartController::class, 'remove'])->name('cart.remove');
Route::post('/pouzivatelske_udaje', [UserData::class, 'update'])->name('pouzivatelske_udaje.update');
Route::delete('/pouzivatelske_udaje/delete', [UserData::class, 'delete'])->name('pouzivatelske_udaje.delete');
Route::post('/platobna_brana', [PlatobnaBranaController::class, 'processPayment'])->name('platobna_brana.process');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/edit/{productId}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/products/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/images/{id}', [AdminController::class, 'destroyImage'])->name('admin.images.destroy');
Route::delete('/admin/products/{id}', [AdminController::class, 'destroy'])->name('admin.products.destroy');
Route::get('/admin/produkt/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('admin/produkt/store', [AdminController::class, 'store'])->name('admin.store');