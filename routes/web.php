<?php

use App\Http\Controllers\NavigationController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard\Dashboard;
/* User */
use App\Http\Livewire\Settings\User\UserList;
use App\Http\Livewire\Settings\User\UserDetails;
/* Trip */
use App\Http\Livewire\Trip\Trip;
use App\Http\Livewire\Trip\CreateTrip;
use App\Http\Livewire\Trip\TripDetails;
use App\Http\Livewire\Trip\Printables\TripTicketPrintout;
/* Fleet */
use App\Http\Livewire\Fleet\Fleet;
use App\Http\Livewire\Fleet\FleetDetails;
/* Departments */
use App\Http\Livewire\Settings\Department\DepartmentList;
use App\Http\Livewire\Settings\Department\DepartmentDetails;
/* Trip Categories */
use App\Http\Livewire\Settings\TripCategory\TripCategoryList;
use App\Http\Livewire\Settings\TripCategory\TripCategoryDetails;
/* Transaction Type */
use App\Http\Livewire\Settings\Transaction\TransactionList;
use App\Http\Livewire\Settings\Transaction\TransactionDetails;
/* Routes */
use App\Http\Livewire\Settings\Route\RouteList;
use App\Http\Livewire\Settings\Route\RouteDetails;
/* Routes */
use App\Http\Livewire\Settings\Tarif\TarifList;
use App\Http\Livewire\Settings\Tarif\TarifDetails;
/* Vehicle Types */
use App\Http\Livewire\Settings\VehicleType\VehicleTypeList;
use App\Http\Livewire\Settings\VehicleType\VehicleTypeDetails;
/* Reservation */
use App\Http\Livewire\Reservation\ReservationList;
use App\Http\Livewire\Reservation\ReservationDetails;
use App\Http\Livewire\Reservation\CreateReservation;
/* Driver */
use App\Http\Livewire\Driver\DriverList;
/* Maintenance */
use App\Http\Livewire\Maintenance\MaintenanceList;
use App\Http\Livewire\Auth\ChangePassword;
/* Report */
use App\Http\Livewire\Reports\BookingSummaryReport;

/* Auto-redirect based on authentication status. */

Route::get('/', [NavigationController::class, 'index'])->name('home');

/* Route group for authenticated and verified users */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/change-password', ChangePassword::class)->name('change-password');

    Route::get('/settings/user-management', UserList::class)->name('user-management');
    Route::get('/settings/user-management/details/{id}', UserDetails::class)->name('user-details');

    Route::get('/driver', DriverList::class)->name('driver');

    Route::get('/settings/departments', DepartmentList::class)->name('departments');
    Route::get('/settings/departments/details/{id?}', DepartmentDetails::class)->name('department-details');

    Route::get('/settings/vehicle-types', VehicleTypeList::class)->name('vehicle-types');
    Route::get('/settings/vehicle-types/details/{id}', VehicleTypeDetails::class)->name('vehicle-type-details');

    Route::get('/settings/trip-categories', TripCategoryList::class)->name('trip-categories');
    Route::get('/settings/trip-categories/details/{id}', TripCategoryDetails::class)->name('trip-category-details');

    Route::get('/settings/routes', RouteList::class)->name('routes');
    Route::get('/settings/routes/details/{id}', RouteDetails::class)->name('routes-details');

    Route::get('/settings/tarif', TarifList::class)->name('tarif');
    Route::get('/settings/tarif/details/{id}', TarifDetails::class)->name('tarif-details');

    Route::get('/fleet-management', Fleet::class)->name('fleet-management');
    Route::get('/fleet-management/details/{id}', FleetDetails::class)->name('fleet-details');

    Route::get('/fleet-maintenance', MaintenanceList::class)->name('maintenance');

    Route::get('/trip-tickets', Trip::class)->name('trip');
    Route::get('/trip-tickets/create/{id}', CreateTrip::class)->name('trip-create');
    Route::get('/trip-tickets/details/{id}', TripDetails::class)->name('trip-details');
    Route::get('/trip-tickets/details/print/{id}', TripTicketPrintout::class)->name('trip-ticket-print');

    Route::get('/reservation/list', ReservationList::class)->name('reservation-list');
    Route::get('/reservation/create', CreateReservation::class)->name('reservation-create');
    Route::get('/reservation/details/{id}', ReservationDetails::class)->name('reservation-details');

    // Reports
    Route::get('/reports/booking-summary', BookingSummaryReport::class)->name('booking-summary-report');
});

require __DIR__ . '/auth.php';
