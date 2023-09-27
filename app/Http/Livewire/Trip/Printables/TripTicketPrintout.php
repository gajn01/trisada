<?php

namespace App\Http\Livewire\Trip\Printables;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use App\Models\TripTicket;
use App\Models\TripCost;
use App\Models\Destination;

class TripTicketPrintout extends Component
{
    public $ticket_id;
    public $tarifCost , $destination_list = [];
    public $releasedTotal, $unreleasedTotal;
    public function mount($id)
    {
        if(!Gate::allows('allow-view','module-trip-ticket')) redirect()->route('home');
        $this->ticket_id = $id;
        $this->tarifCost = TripCost::where('trip_ticket_id',$id)->get();
        $this->releasedTotal = $this->tarifCost->sum('release_amount');
        $this->unreleasedTotal = $this->tarifCost->sum('unrelease_amount');
    }
    public function render()
    {
        $trip_ticket = TripTicket::findOrFail($this->ticket_id);
        if($trip_ticket->reservation->destination == 0){
            $this->destination_list = Destination::where('reservation_id',$trip_ticket->reservation_id)->get();
            $trip_ticket->reservation->trip_distance = $this->destination_list->sum('km');
        }
        return view('livewire.trip.printables.trip-ticket-printout',['ticket' => $trip_ticket])->layout('layouts.report');
    }
}
