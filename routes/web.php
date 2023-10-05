<?php

use App\Http\Controllers\NavigationController;
use App\Http\Livewire\Customer\CustomerDetails;
use App\Http\Livewire\Driver\DriverDetails;
use App\Http\Livewire\GeocodeComponent;
use App\Http\Livewire\Terminal\TerminalList;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard\Dashboard;
/* User */
use App\Http\Livewire\Auth\ChangePassword;
use App\Http\Livewire\Customer\CustomerList;
use App\Http\Livewire\Driver\DriverList;
use App\Http\Livewire\Toda\TodaDetails;
use App\Http\Livewire\Toda\TodaList;
use App\Http\Livewire\User\UserList;

/* Auto-redirect based on authentication status. */

Route::get('/', [NavigationController::class, 'index'])->name('home');

/* Route group for authenticated and verified users */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/change-password', ChangePassword::class)->name('change-password');
/* 
    Route::get('/settings/user-management', UserList::class)->name('user-management');
    Route::get('/settings/user-management/details/{id}', UserDetails::class)->name('user-details');

    Route::get('/settings/user-management', UserList::class)->name('user-management');
 */
      /* Toda */
      Route::get('toda', TodaList::class)->name('toda-list');
      Route::get('toda/{id}', TodaDetails::class)->name('toda-details');
  
       /* Terminal */
       Route::get('terminal', TerminalList::class)->name('terminal-list');

       /* User */
       Route::get('user', UserList::class)->name('user-list');

       Route::get('driver', DriverList::class)->name('driver-list');
       Route::get('driver/{id}', DriverDetails::class)->name('driver-details');

       Route::get('customer', CustomerList::class)->name('customer-list');
       Route::get('customer/{id}', CustomerDetails::class)->name('customer-details');

       Route::get('user', UserList::class)->name('user-list');


       Route::get('/geocode', GeocodeComponent::class);
});

/* Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
}); */
require __DIR__ . '/auth.php';
