<?php

namespace App\Http\Livewire\Dashboard;
use App\Helpers\AvailabilityHelper;
use App\Models\Driver;
use Livewire\Component;

class DriverStatusCard extends Component
{
    public function render()
    {
        $date_columns = AvailabilityHelper::getDatesBetween(now(),now().'+6 Day');
        $drivers = Driver::whereNull('department_id')->get();
        return view('livewire.dashboard.driver-status-card',['date_columns' => $date_columns,'drivers_list' =>$drivers]);
    }
}
