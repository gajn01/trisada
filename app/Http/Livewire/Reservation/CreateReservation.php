<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Driver as DriverModel;
use App\Models\Destination as DestinationModel;
use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use App\Models\Department;
use App\Models\Reservation;
use App\Models\VehicleType;
use App\Models\TripCategory;
use App\Helpers\UIHelper;

class CreateReservation extends Component
{
    public $driver_option = "withDriver";
    public $is_multiple_trip = false;
    public $destination_trips = [];
    public $destination;
    public Reservation $reservation;
    protected function rules()
    {
        return [
            'reservation.department_id' => 'required|integer',
            'reservation.head_count' => 'required|integer|min:1|max:50',
            'reservation.driver' => 'required_if:driver_option,withDriver',
            'reservation.pickup_location' => '',
            'reservation.pickup_date' => 'required|date',
            'reservation.return_date' => 'required|date|after:reservation.pickup_date',
            'reservation.destination' => 'required_if:is_multiple_trip,false',
            'reservation.special_instruction' => 'nullable|string',
            'reservation.purpose' => 'required|string',
            'reservation.trip_category_id' => 'required|integer',
            'reservation.trip_distance' => 'required|integer|min:1',
            'destination_trips' => 'required_if:is_multiple_trip,true',
        ];
    }
    protected $validationAttributes = [
        'reservation.department_id' => 'department',
        'reservation.head_count' => 'passenger capacity',
        'reservation.driver' => 'driver name',
        'reservation.pickup_date' => 'pick-up date',
        'reservation.return_date' => 'return date',
        'reservation.destination' => 'destination',
        'reservation.special_instruction' => 'special instructions',
        'reservation.purpose' => 'purpose (trip details)',
        'reservation.trip_category_id' => 'trip category',
        'reservation.pickup_location' => 'pick-up location',
    ];
    public function addDestination()
    {
        if($this->destination){
            $newDestination = [
                'reservation_id' => '',
                'destination' => $this->destination,
                'order' => $this->destination_trips != null ? count($this->destination_trips) + 1 : 1,
                'km' => 0
            ];
            array_push($this->destination_trips, $newDestination);
            $this->destination = null;
        }
       
    }
    public function mount()
    {
        if (!Gate::allows('allow-view', 'module-reservation'))
            redirect()->route('home');
        $this->reservation = new Reservation();
        $this->reservation->head_count = 1;
        $this->reservation->trip_distance = 1;
        $this->reservation->pickup_location = "Head Office";
    }
    public function save()
    {
        try {
            $this->validate();
            if(Gate::allows('allow-view', 'module-reservation-pre-approval')){
                $this->reservation->status = 1;
            }
            $this->reservation->own_driver = $this->driver_option === "withDriver" ? true : false;
            $this->reservation->driver = $this->driver_option === "withDriver" ? $this->reservation->driver : null;
            $this->reservation->destination = $this->destination_trips ? '0' : $this->reservation->destination;
            $userId = auth()->user()->id;
            $this->reservation->created_by_id = $userId;
            $this->reservation->last_updated_by_id = $userId;
            $this->reservation->save();
            if ($this->destination_trips) {
                foreach ($this->destination_trips as $key => &$value) {
                    $value['reservation_id'] = $this->reservation->id;
                    $value['created_by_id'] = $userId;
                    $value['last_updated_by_id'] = $userId;
                }
                unset($value);
                DestinationModel::insert($this->destination_trips);
            }
            return redirect()->route('reservation-details', ['id' => $this->reservation->id]);
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
    public function render()
    {
        if(auth()->user()->user_type > 1){
            $this->reservation->department_id = auth()->user()->departments[0]->id;
        }
        $driver_list = DriverModel::where('department_id', $this->reservation->department_id)->get();
        $department_list = Department::when(auth()->user()->user_type > 1, function ($q) {
            $depIds = auth()->user()->departments->pluck('id');
            return $q->whereIn('id', $depIds);
        })->get();
        $vehicle_types = VehicleType::get();
        $trip_categories = TripCategory::get();
        return view('livewire.reservation.create-reservation',
            ['department_list' => $department_list, 'vehicle_types' => $vehicle_types, 'trip_categories' => $trip_categories, 'driver_list' => $driver_list]
        );
    }

}