<?php

namespace App\Http\Livewire\Fleet;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Helpers\UIHelper;

class FleetDetails extends Component
{
    public $editMode; //0 = off, 1 = basic details, 2 = registration details
    public Vehicle $vehicle;

    protected $listeners = ['showToast' => 'showSubModuleToast'];

    protected function rules()
    {
        if($this->editMode == 1){
            return [
                'vehicle.code' => 'required|string|max:10|unique:vehicles,code,'. $this->vehicle->id .'',
                'vehicle.make' => 'required|string|max:50',
                'vehicle.model' => 'required|string|max:50',
                'vehicle.plate_number' => 'required|string|max:30|unique:vehicles,plate_number,'. $this->vehicle->id .'',
                'vehicle.fuel_type' => ['required', Rule::in(['Gas', 'Diesel'])],
                'vehicle.fuel_capacity' => 'required|integer|min:1',
                'vehicle.vehicle_type_id' => 'required|integer',
                'vehicle.passenger_capacity' => 'required|integer|min:1',
                'vehicle.coding_day' => 'required|integer',
            ];
        }else{
            return [
                'vehicle.mv_file_number' => 'required|string|max:30',
                'vehicle.cr_number' => 'required|string|max:20',
                'vehicle.registration_date' => 'required|date',
                'vehicle.engine_number' => 'required|string|max:20',
                'vehicle.chassis_number' => 'required|string|max:20',
                'vehicle.color' => 'required|string|max:20',
            ];
        }
    }

    public function showSubModuleToast($caption,$msg,$class)
    {
        UIHelper::flashMessage($this,$caption,$msg,$class);
    }

    public function mount($id)
    {
        if(!Gate::allows('allow-view','module-fleet-management')) redirect()->route('home');
        $this->editMode = 0;
        $this->vehicle = Vehicle::findOrFail($id);
    }

    public function updateBasicDetails()
    {
        $this->vehicle->refresh();
        $this->editMode = 1;
    }

    public function updateRegistrationDetails()
    {
        $this->vehicle->refresh();
        $this->editMode = 2;
    }


    public function saveBasicDetails()
    {
        if(!Gate::allows('allow-edit','module-fleet-management')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        try
        {
            $this->validate();
            $this->vehicle->last_updated_by_id = auth()->user()->id;
            $this->vehicle->save();
            UIHelper::flashMessage($this,'Saving Successful','Basic details updated.','text-success');
            $this->editMode = 0;
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }

    }


    public function saveRegistrationDetails()
    {
        if(!Gate::allows('allow-edit','module-fleet-management')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        try
        {
            $this->validate();
            $this->vehicle->last_updated_by_id = auth()->user()->id;
            $this->vehicle->save();
            UIHelper::flashMessage($this,'Saving Successful','LTO vehicle registration details updated.','text-success');
            $this->editMode = 0;
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }

    }

    public function cancel()
    {
        $this->editMode = 0;
        $this->vehicle->refresh();
    }

    public function render()
    {
        $vehicle_types = VehicleType::get();
        return view('livewire.fleet.fleet-details',['vehicle_types' => $vehicle_types]);
    }
}
