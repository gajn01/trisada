<?php

use App\Http\Controllers\NavigationController;
use App\Http\Livewire\Terminal\TerminalDetails;
use App\Http\Livewire\Terminal\TerminalList;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard\Dashboard;
/* User */
use App\Http\Livewire\Settings\User\UserDetails;

use App\Http\Livewire\Auth\ChangePassword;
use App\Http\Livewire\Toda\TodaDetails;
use App\Http\Livewire\Toda\TodaList;
use App\Http\Livewire\User\UserList;

/* Auto-redirect based on authentication status. */

Route::get('/', [NavigationController::class, 'index'])->name('home');

/* Route group for authenticated and verified users */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/change-password', ChangePassword::class)->name('change-password');

    Route::get('/settings/user-management', UserList::class)->name('user-management');
    Route::get('/settings/user-management/details/{id}', UserDetails::class)->name('user-details');

    Route::get('/settings/user-management', UserList::class)->name('user-management');

      /* Toda */
      Route::get('toda', TodaList::class)->name('toda-list');
      Route::get('toda/{id}', TodaDetails::class)->name('toda-details');
  
       /* Terminal */
       Route::get('terminal', TerminalList::class)->name('terminal-list');
       Route::get('terminal/{id}', TerminalDetails::class)->name('terminal-details');

       /* User */
       Route::get('user', UserList::class)->name('user-list');

    
});

require __DIR__ . '/auth.php';
