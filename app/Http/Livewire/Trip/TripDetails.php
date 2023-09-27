<?php

namespace App\Http\Livewire\Trip;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use App\Helpers\UIHelper;
use App\Models\TripTicket;
use App\Models\Destination as DestinationModel;
use App\Models\TripCost;


class TripDetails extends Component
{

    public $trip_id;
    public TripTicket $trip_ticket;
    public $initial_odometer_reading , $initial_fuel_bar , $final_odometer_reading, $final_fuel_bar = 0;
    public $received_by = '';
    public $tarifCost , $destination_list = [];
    public $releasedTotal, $unreleasedTotal;
    public $return_date;

    protected function rules()
    {
        if ($this->trip_ticket->status == 0) {
            return [
                'initial_odometer_reading' => 'integer|min:0',
                'initial_fuel_bar' => 'integer|min:0',
                'received_by' => 'required|string',
                'tarifCost.*.release_amount' => 'integer|min:0',
                'tarifCost.*.unrelease_amount' => 'integer|min:0',
            ];
        } else {
            return [
                'final_fuel_bar' => 'required|integer|min:0',
                'final_odometer_reading' => 'integer|gte:trip_ticket.initial_odometer_reading',
                'return_date' => 'required|date|after:trip_ticket.pickup_date',
                'tarifCost.*.release_amount' => 'integer|min:0',
                'tarifCost.*.unrelease_amount' => 'integer|min:0',
            ];
        }
    }
    public function mount($id = null)
    {
        if(!Gate::allows('allow-view','module-trip-ticket')) redirect()->route('home');
        $this->trip_id = $id;
        $this->trip_ticket = TripTicket::when(auth()->user()->user_type > 1, function($q){
            return $q->whereHas('reservation', function($q){
                $depIds = auth()->user()->departments->pluck('id');
                return $q->whereIn('department_id',$depIds);
            });
        })
        ->findOrFail($id);
        $this->return_date = date('Y-m-d H:i:s',strtotime(now()));
        $this->tarifCost = TripCost::where('trip_ticket_id',$this->trip_id)->get();
        $this->releasedTotal = $this->tarifCost->sum('release_amount');
        $this->unreleasedTotal = $this->tarifCost->sum('unrelease_amount');
    }
    public function resetFields()
    {
        $this->initial_fuel_bar = 0;
        $this->received_by = '';
        $this->initial_odometer_reading = 0;
        $this->final_odometer_reading = 0;
        $this->final_fuel_bar = 0;
        $this->return_date = now();
    }
    public function release()
    {
        if(!Gate::allows('access-enabled','module-trip-ticket-releasing')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            $this->emit('close-modal');
            return;
        }
        $this->trip_ticket->refresh();
        if($this->trip_ticket->status > 0)
        {
            UIHelper::flashMessage($this,'Action Cancelled','Vehicle was already released.','text-danger');
            $this->emit('close-modal');
            return;
        }
        // $this->validate();
        try {
            $this->trip_ticket->update([
                'initial_fuel_bar' => $this->initial_fuel_bar,
                'initial_odometer_reading' => $this->initial_odometer_reading,
                'received_by' => $this->received_by,
                'released_by_id' => auth()->user()->id,
                'release_date' => now(),
                'status' => 1,
            ]);
            $this->resetFields();
            $this->emit('close-modal');
            UIHelper::flashMessage($this,'Saving Successful','Vehicle released.','text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
    public function close()
    {
        if(!Gate::allows('access-enabled','module-trip-ticket-closing')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            $this->emit('close-modal');
            return;
        }
        $this->trip_ticket->refresh();
        if($this->trip_ticket->status != 1)
        {
            UIHelper::flashMessage($this,'Action Cancelled','You can only close ticket with "released" status.','text-danger');
            $this->emit('close-modal');
            return;
        }
        // $this->validate();
        try {
            $this->trip_ticket->update([
                'final_fuel_bar' => $this->final_fuel_bar,
                'final_odometer_reading' => $this->final_odometer_reading,
                'return_date' => $this->return_date,
                'closed_by_id' => auth()->user()->id,
                'closed_date' => date('Y-m-d H:i:s',strtotime(now())),
                'status' => 2,
            ]);

            $this->resetFields();
            $this->emit('close-modal');
            UIHelper::flashMessage($this,'Saving Successful','Ticket Closed.','text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
    public function onCancelTripTicket(){
        $this->trip_ticket->status = 3;
        $this->trip_ticket->save();
        UIHelper::flashMessage($this, 'Update Successful', 'The trip ticket has been canceled.', 'text-success');
        $this->emit('close-modal');
    }
    public function render()
    {
        $trip_details = TripTicket::findOrFail($this->trip_id);
        $trip_details->initial_odometer_reading ?? 0;
        $trip_details->initial_fuel_bar ?? 0;
        $trip_details->final_fuel_bar ?? 0;
        $trip_details->final_odometer_reading ?? 0;

        if($trip_details->reservation->destination == 0){
            $this->destination_list = DestinationModel::where('reservation_id',$trip_details->reservation_id)->get();
            // $trip_details->reservation->trip_distance = $this->destination_list->sum('km');
        }
        try {
            $this->releasedTotal = $this->tarifCost->sum('release_amount');
            $this->unreleasedTotal = $this->tarifCost->sum('unrelease_amount');
        } catch (\Throwable $th) {
            UIHelper::flashMessage($this, 'Error', 'Please input digits only', 'text-danger');
        }
        return view('livewire.trip.trip-details', ['trip_data' => $trip_details ,]);
    }
}
