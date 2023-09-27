<?php

namespace App\Http\Livewire\Reservation;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;
use App\Models\Reservation;
use App\Helpers\UIHelper;
use App\Helpers\AvailabilityHelper;
use App\Models\Destination as DestinationModel;
use App\Models\Driver;
use App\Models\Vehicle;

class ReservationDetails extends Component
{
    public $reservation_id;
    public Reservation $reservation;
    public $mode; //0 = cancellation, 1 = decline, 2 = approval
    public $selectedVehicle;
    public $selectedDriver;
    public $destination_list;
    protected function rules()
    {
        if($this->mode == 0){
            return [
                'reservation.cancel_reason' => 'required|integer',
                'reservation.remarks' => 'required|max:250',
            ];
        }else if($this->mode == 1){
            return [
                'reservation.decline_reason' => 'required|integer',
                'reservation.remarks' => 'required|max:250',
            ];
        }else{
            return [
                'reservation.pickup_location' => 'required|max:250',
                'reservation.trip_distance' => 'required|integer|min:1',
                'selectedVehicle' => 'required|integer',
                'selectedDriver' => 'required_if:reservation.own_driver,0',
                'destination_list.*.km' => 'required|numeric',
            ];
        }
    }
    protected $validationAttributes = [
        'reservation.vehicle_id' => 'vehicle',
        'reservation.cancel_reason' => 'reason',
        'reservation.decline_reason' => 'reason',
    ];
    public function mount($id = null)
    {
        if(!Gate::allows('allow-view','module-reservation')) redirect()->route('home');
        $this->reservation_id = $id;
        $this->reservation = Reservation::when(auth()->user()->user_type > 1 && Gate::allows('access-enabled','module-reservation-approval') == false, function($q){
            $depIds = auth()->user()->departments->pluck('id');
            return $q->whereIn('department_id',$depIds);
        })
        ->findOrFail($this->reservation_id);
        if($this->reservation->destination == 0){
            $this->destination_list = DestinationModel::where('reservation_id',$this->reservation_id)->get();
        }
    }
    public function render()
    {
       /*  $drivers = AvailabilityHelper::getAvailableDrivers($this->reservation->pickup_date,$this->reservation->return_date);
        $vehicles = AvailabilityHelper::getAvailableVehicles($this->reservation->pickup_date,$this->reservation->return_date); */
        $drivers = Driver::get();
        $vehicles = Vehicle::get();
        return view('livewire.reservation.reservation-details', ['vehicles' => $vehicles,'drivers' => $drivers]);
    }
    public function setMode($mode)
    {
        $this->reservation->refresh();
        $this->mode = $mode;
    }
    public function cancel()
    {
        $this->selectedDriver = null;
        $this->selectedVehicle = null;
        $this->mode = null;
        $this->reservation->refresh();
    }
    public function selectVehicle($id)
    {
        $this->selectedVehicle = $id;
    }
    public function selectDriver($id)
    {
        $this->selectedDriver = $id;
    }
    public function preApprovedBooking(){
        $this->updateReservationStatus(1, 'Reservation pre-approved.');
    }
    public function confirmBooking()
    {
        $this->updateReservationStatus(2, 'Reservation approved.');
    }
    public function declineReservation()
    {
        $this->updateReservationStatus(3, 'Reservation declined.');
    }
    public function cancelReservation()
    {
        $this->updateReservationStatus(4, 'Reservation cancelled.');
    }
    public function updateDriver(){
        try {
            $this->reservation->driver = is_null($this->selectedDriver) ? null : $this->selectedDriver;
            $this->reservation->driver_id = is_null($this->selectedDriver) ? null : $this->selectedDriver;
            $this->reservation->save();
            $this->emit('close-modal');
            UIHelper::flashMessage($this, 'Update Successful', 'Update Driver', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
            $this->emit('close-modal');
        }
        $this->reservation->refresh();
    }
    public function updateVehicle(){
        try {
            $this->reservation->vehicle_id = $this->selectedVehicle;
            $this->reservation->save();
            $this->emit('close-modal');
            UIHelper::flashMessage($this, 'Update Successful', 'Update Vehicle', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
            $this->emit('close-modal');
        }
        $this->reservation->refresh();
    }
    public function updateReservationStatus($status, $successMessage)
    {
       /*  if ($this->reservation->status > $status) {
            UIHelper::flashMessage($this, 'Action Cancelled', "You can only perform this action on pending status reservations.", 'text-danger');
            $this->emit('close-modal');
            return;
        } */
        try {
            $this->reservation->status = $status;
            switch ($status) {
                case 1: // Pre Reservation
                    $this->reservation->booking_approval_by_id = auth()->user()->id;
                    $this->reservation->booking_approval_date = now();
                    break;
                case 2: // Confirm Booking
                    $this->validate();
                    $this->reservation->last_updated_by_id = auth()->user()->id;
                    $this->reservation->driver = is_null($this->selectedDriver) ? null : $this->selectedDriver;
                    $this->reservation->driver_id = is_null($this->selectedDriver) ? null : $this->selectedDriver;
                    $this->reservation->vehicle_id = $this->selectedVehicle;
                    $this->reservation->booking_approval_by_id = auth()->user()->id;
                    $this->reservation->booking_approval_date = now();
                    if ($this->reservation->destination == 0) {
                        foreach ($this->destination_list as $destination) {
                            $destinationModel = DestinationModel::find($destination->id);
                            $destinationModel->km = $destination->km;
                            $destinationModel->save();
                        }
                    }
                    $this->mode = null;
                    break;
                case 3: // Decline Reservation
                    $this->reservation->declined_by_id = auth()->user()->id;
                    $this->reservation->declined_date = now();
                    break;
                case 4: // Cancel Reservation
                    $this->reservation->cancelled_by_id = auth()->user()->id;
                    $this->reservation->cancellation_date = now();
                    break;
                case 5: // Cancel Reservation
                    $this->reservation->driver = is_null($this->selectedDriver) ? null : $this->selectedDriver;
                    $this->reservation->driver_id = is_null($this->selectedDriver) ? null : $this->selectedDriver;
                    break;
            }
            $this->reservation->save();
            $this->emit('close-modal');
            UIHelper::flashMessage($this, 'Update Successful', $successMessage, 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
            $this->emit('close-modal');
        }
    }
  /*   public function createTicket(){
        $this->reservation->status = 4;
        $this->reservation->booking_approval_by_id = auth()->user()->id;
        $this->reservation->booking_approval_date = now();
        $this->reservation->last_updated_by_id = auth()->user()->id;
        $this->reservation->trip_ticket()->create([
                'ticket_date' => date('Y-m-d',strtotime(now())),
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
        $this->reservation->save();
        $this->emit('close-modal');
        UIHelper::flashMessage($this, 'Create Successful', 'Trip ticket created successfully.', 'text-success');
        $this->reservation->refresh();
    } */
}