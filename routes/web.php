<?php

use App\Http\Controllers\FrontController;
use App\Models\About;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('utama', [
        'products' => Produk::all()
    ]);
})->name('utama');


Route::get('/about', function () {
    return view('about',[
        'abouts' => About::all()
    ]);
})->name('about');


// Route::get('/', [FrontController::class, 'index'])->name('front.index');

// Route::get('/browse/{kategori}', [FrontController::class, 'kategori'])->name('front.kategori');

