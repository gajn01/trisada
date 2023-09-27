<?php

namespace App\Http\Livewire\Settings\VehicleType;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use App\Models\VehicleType;
use App\Helpers\UIHelper;

class VehicleTypeDetails extends Component
{
    public $isedit;
    public VehicleType $vehicleType;

    protected function rules()
    {
        return [
            'vehicleType.code' => 'required|string|max:10|unique:vehicle_types,code,'. $this->vehicleType->id .'',
            'vehicleType.name' => 'required|string|max:50',
            'vehicleType.description' => 'string',
        ];
    }

    public function mount($id){
        if(!Gate::allows('allow-view','module-vehicle-types')) redirect()->route('home');
        $this->isedit = false;
        $this->vehicleType = VehicleType::findOrFail($id);
    }

    public function edit()
    {
        $this->isedit = true;
    }

    public function cancel()
    {
        $this->isedit = false;
        $this->vehicleType = VehicleType::findOrFail($this->vehicleType->id);
    }

    public function save()
    {
        if(!Gate::allows('allow-edit','module-vehicle-types')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        try
        {
            $this->validate();
            $this->vehicleType->last_updated_by_id = auth()->user()->id;
            $this->vehicleType->save();
            UIHelper::flashMessage($this,'Update Successful','Vehicle type details updated.','text-success');
            $this->isedit = false;
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }

    }

    public function render()
    {
        return view('livewire.settings.vehicle-type.vehicle-type-details');
    }
}
