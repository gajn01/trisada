<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\TripTicket;

class OpenTicketCard extends Component
{
    public function render()
    {
        $count = TripTicket::whereNot('status',2)->get()->count(); 

        return view('livewire.dashboard.open-ticket-card',['count' => $count]); 
    }
}
