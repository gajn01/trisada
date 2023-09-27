<?php

namespace App\Http\Livewire\Settings\VehicleType;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Models\VehicleType;
use App\Helpers\UIHelper;

class VehicleTypeList extends Component
{
    use WithPagination, Sortable;
    protected $paginationTheme='bootstrap';
    public $search = '';
    public $displaypage = 10;
    private $selectedID;
    public $isedit = false;
    public VehicleType $vehicleType;
    protected function rules()
    {
        return [
            'vehicleType.code' => 'required|string|max:10|unique:vehicle_types,code,'. $this->vehicleType->id .'',
            'vehicleType.name' => 'required|string|max:50',
            'vehicleType.description' => 'string',
        ];
    }
    public function mount()
    {
        if(!Gate::allows('allow-view','module-vehicle-types')) redirect()->route('home');
    }
    public function create()
    {
        $this->vehicleType = new VehicleType();
        $this->vehicleType->description = '';
        $this->isedit = true;
    }
    public function cancel()
    {
        if($this->isedit == true)
        {
            $this->resetValidation();
            $this->isedit = false;
            $this->vehicleType = new VehicleType();
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
        $this->vehicleType = VehicleType::findOrFail($id);
    }
    public function delete()
    {
        if(!Gate::allows('allow-delete','module-vehicle-types')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        try
        {
            $this->vehicleType->delete();
            UIHelper::flashMessage($this,'Delete Successful','Vehicle type deleted.','text-success');
            $this->vehicleType = new VehicleType();
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
        if(!Gate::allows('allow-create','module-vehicle-types')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            $this->emit('close-modal');
            return;
        }
        try
        {
            $this->validate();
            $this->vehicleType->created_by_id = auth()->user()->id;
            $this->vehicleType->last_updated_by_id = auth()->user()->id;
            $this->vehicleType->save();
            redirect()->route('vehicle-type-details',['id' => $this->vehicleType->id]);
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
            $this->emit('close-modal');
        }
    }
    public function render()
    {
        $vehicleTypes = VehicleType::where(function($q){
            return $q->where('code','like','%'.$this->search.'%')
                ->orWhere('name','like','%'.$this->search.'%')
                ->orWhere('description','like','%'.$this->search.'%');
        })
        ->when($this->sortdirection != '', function ($q) {
            return $q->orderBy($this->sortby,$this->sortdirection);
        })
        ->paginate($this->displaypage);
        return view('livewire.settings.vehicle-type.vehicle-type-list',['vehicleTypes'=> $vehicleTypes]);
    }
}
