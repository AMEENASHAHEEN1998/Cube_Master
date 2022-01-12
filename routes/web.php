<?php

use App\Http\Livewire\Invoices;
use App\Http\Livewire\Products;
use App\Http\Livewire\Sections;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/sections', [SectionController::class, 'index'])->name('sections');
Route::get('/create' , [App\Http\Livewire\Sections::class , 'create'])->name('create');
Route::middleware(['auth', 'verified'])->get('/sections', App\Http\Livewire\Sections::class)->name('sections');
Route::middleware(['auth', 'verified'])->get('/products', App\Http\Livewire\Products::class)->name('products');
Route::middleware(['auth', 'verified'])->get('/invoices', App\Http\Livewire\Invoices::class)->name('invoices');
Route::get('calculate' , [UserController::class , 'calculate'])->name('calculate');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
