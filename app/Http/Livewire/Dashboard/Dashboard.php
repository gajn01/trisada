<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;


class Dashboard extends Component
{
    public function render()
    {

        if(!Gate::allows('allow-view','module-dashboard')) redirect()->route('reservation-list');
        return view('livewire.dashboard.dashboard');
    }
}
