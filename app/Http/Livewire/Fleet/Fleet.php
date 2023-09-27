<?php

namespace App\Http\Livewire\Fleet;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Helpers\UIHelper;

class Fleet extends Component
{
    use WithPagination, Sortable;

    protected $paginationTheme='bootstrap';

    public $search = '';
    public $displaypage = 10;
    private $selectedID;
    public $isedit = false;
    public Vehicle $vehicle;

    protected function rules()
    {
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
    }

    protected function validationAttributes()
    {
        return [
            'vehicle_type_id' => 'vehicle type',
        ];
    }

    public function boot()
    {

    }

    public function mount()
    {
        if(!Gate::allows('allow-view','module-fleet-management')) redirect()->route('home');
    }

    public function create()
    {
        $this->vehicle = new Vehicle();
        $this->vehicle->fuel_capacity = 1;
        $this->vehicle->passenger_capacity = 1;
    }

    public function cancel()
    {
        if($this->isedit == true)
        {
            $this->resetValidation();
            $this->isedit = false;
            $this->vehicle = new Vehicle();
        }
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDisplaypage()
    {
        $this->resetPage();
    }

    public function markDelete($id)
    {
        $this->vehicle = Vehicle::findOrFail($id);
    }

    public function delete()
    {
        if(!Gate::allows('allow-delete','module-item-masterlist')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        try
        {
            $this->vehicle->delete();
            UIHelper::flashMessage($this,'Delete Successful','Vehicle deleted.','text-success');
            $this->vehicle = new Vehicle();
        }
        catch(QueryException $e)
        {
            if($e->getCode() == 23000)
            {
                UIHelper::flashMessage($this,'Action Cancelled','Cannot delete record with transactions.','text-danger');
            }else{
                UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
            }
        }

    }

    public function save()
    {
        if(!Gate::allows('allow-create','module-fleet-management')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            $this->emit('close-modal');
            return;
        }
        try
        {
            $this->validate();
            $this->vehicle->mv_file_number = '';
            $this->vehicle->cr_number = '';
            $this->vehicle->chassis_number = '';
            $this->vehicle->engine_number = '';
            $this->vehicle->color = '';
            $this->vehicle->status = 1;
            $this->vehicle->created_by_id = auth()->user()->id;
            $this->vehicle->last_updated_by_id = auth()->user()->id;
            $this->vehicle->save();
            redirect()->route('fleet-details',['id' => $this->vehicle->id]);
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
            $this->emit('close-modal');
        }

    }


    public function render()
    {
        $vehicles = Vehicle::where(function($q){
            return $q->where('code','like','%'.$this->search.'%')
                ->orWhere('make','like','%'.$this->search.'%')
                ->orWhere('model','like','%'.$this->search.'%')
                ->orWhere('fuel_type','like','%'.$this->search.'%')
                ->orWhere('plate_number','like','%'.$this->search.'%');
        })
        ->when($this->sortdirection != '', function ($q) {
            return $q->orderBy($this->sortby,$this->sortdirection);
        })
        ->paginate($this->displaypage);
        $vehicle_types = VehicleType::get();
        return view('livewire.fleet.fleet',['vehicles' => $vehicles, 'vehicle_types' => $vehicle_types]);
    }
}
