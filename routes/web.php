<?php


use Illuminate\Support\Facades\Route;

use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Login;

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
    return view('welcome');
});

Route::get('/login',Login::class)->name('login');

Route::get('/dashboard',Dashboard::class)->name('dashboard');


