<?php

namespace App\Http\Livewire\Trip;

use Livewire\Component;
use App\Helpers\UIHelper;
use App\Models\Reservation;
use App\Models\Tarif;
use App\Models\TripCost;
use App\Models\Destination;

class CreateTrip extends Component
{
    public $releasedTotal, $unreleasedTotal, $transaction_type = 2, $bookingID;
    public $destinationList = [];
    public $tarifList;
    public $tarifCost = [];
    public Reservation $reservationDetails;
    public TripCost $tripCost;
    public function mount($id)
    {
        $this->bookingID = $id;
        $this->reservationDetails = Reservation::findOrFail($id);
        $this->tarifList = Tarif::get();
        $this->tarifCost = $this->reconstructTarif();
    }
    public function render()
    {
        if ($this->reservationDetails->destination == '0') {
            $destinationList = Destination::where('reservation_id', $this->bookingID)->get();
            foreach ($destinationList as $key => $value) {
                $this->destinationList = $destinationList->pluck('destination')->toArray();
                $this->reservationDetails->trip_distance += $value->km;
            }
        }
        try {
            $this->releasedTotal = $this->tarifCost->sum('release_amount');
            $this->unreleasedTotal = $this->tarifCost->sum('unrelease_amount');
        } catch (\Throwable $th) {
            UIHelper::flashMessage($this, 'Error', 'Please input digits only', 'text-danger');
        }
        return view('livewire.trip.create-trip', ['tarifCost' => $this->tarifCost]);
    }
    public function reconstructTarif()
    {
        return $this->tarifList->map(fn ($tarif) =>
        [
            'tarif_description' => $tarif['description'],
            'release_amount' => 0,
            'unrelease_amount' => 0,
        ]);
    }
    public function onCreate()
    {
        $this->reservationDetails->status = 5;
        $this->reservationDetails->booking_approval_by_id = auth()->user()->id;
        $this->reservationDetails->booking_approval_date = now();
        $this->reservationDetails->last_updated_by_id = auth()->user()->id;
        $trip_ticket = $this->reservationDetails->trip_ticket()->create([
            'ticket_date' => now()->format('Y-m-d'),
            'transaction_type' => $this->transaction_type,
            'status' => 0,
            'release_date' => null,
            'return_date' => null,
            'initial_fuel_bar' => 0,
            'final_fuel_bar' => 0,
            'initial_odometer_reading' => 0,
            'final_odometer_reading' => 0,
            'released_by_id' => null,
            'received_by' => '',
            'created_by_id' => auth()->user()->id,
            'closed_by_id' => null,
        ]);
        $this->reservationDetails->save();
        $this->tarifCost->each(function ($result) use ($trip_ticket) {
            if (is_array($result)) {
                $result['trip_ticket_id'] = $trip_ticket->id;
                $result['created_by_id'] = auth()->user()->id;
                $result['last_updated_by_id'] = auth()->user()->id;
                TripCost::create($result);
            }
        });
        return redirect()->route('trip-details', ['id' => $trip_ticket->id]);
    }
}
