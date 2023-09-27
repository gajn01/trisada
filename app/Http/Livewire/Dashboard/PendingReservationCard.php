<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Models\Reservation;

class PendingReservationCard extends Component
{
    public function render()
    {
        $count = Reservation::when(auth()->user()->user_type > 1 && Gate::allows('access-enabled','module-reservation-approval') == false, function($q){
            $depIds = auth()->user()->departments->pluck('id');
            return $q->whereIn('department_id',$depIds);
        })
        ->where('status',0)->get()->count();
        return view('livewire.dashboard.pending-reservation-card',['count' => $count]);
    }
}
