<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Helpers\AvailabilityHelper;
use App\Models\Vehicle;
class FleetStatusCard extends Component
{

    public function render()
    {
        $date_columns = AvailabilityHelper::getDatesBetween(now(),now().'+6 Day');
        $vehicles = Vehicle::where('status',1)->get();

        return view('livewire.dashboard.fleet-status-card',['date_columns' => $date_columns,'vehicles' => $vehicles]);
    }
}
