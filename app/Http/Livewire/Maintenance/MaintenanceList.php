<?php

namespace App\Http\Livewire\Maintenance;

use App\Models\Vehicle as VehicleModel;
use App\Models\VehicleMaintenance as VehicleMaintenanceModel;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use Illuminate\Support\Facades\Gate;

class MaintenanceList extends Component
{
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';

    public $vehicle_maintenance_id;
    public $displaypage = 10;
    public $search = '';
    public $isedit = false;
    public VehicleMaintenanceModel $vehicle_maintenances;

    protected function rules()
    {
        return [
            'vehicle_maintenances.vehicle_id' => 'required|int',
            'vehicle_maintenances.' . ($this->isedit ? 'end_date' : 'start_date') => 'required|date',
            'vehicle_maintenances.remarks' => 'required|string|max:255',
        ];
    }
    protected $validationAttributes = [
        'vehicle_maintenances.vehicle_id' => 'Vehicle id',
        'vehicle_maintenances.start_date' => 'Start date',
        'vehicle_maintenances.end_date' => 'End date',
        'vehicle_maintenances.remarks' => 'Maintenance notes',
    ];
    public function render()
    {
        $vehicles = VehicleModel::all();
        $maintenance_list = VehicleMaintenanceModel::where(function ($q) {
                $q->whereHas('vehicle', function ($q) {
                    $q->where('vehicles.make', 'like', '%' . $this->search . '%');
                    $q->orWhere('vehicles.model', 'like', '%' . $this->search . '%');
                    $q->orWhere('vehicles.code', 'like', '%' . $this->search . '%');
                })
                    ->orWhere('start_date', 'like', '%' . $this->search . '%')
                    ->orWhere('end_date', 'like', '%' . $this->search . '%')
                    ->orWhere('remarks', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortby != '', function ($query) {
                return $query->join('vehicles', 'vehicles.id', '=', 'vehicle_maintenances.vehicle_id')
                    ->orderBy($this->sortby, $this->sortdirection === 'desc' ? 'desc' : 'asc');
            })
            ->paginate($this->displaypage);
        return view('livewire.maintenance.maintenance-list', ['vehicles' => $vehicles, 'maintenance_list' => $maintenance_list]);
    }
    private function initializeModel($isEdit)
    {
        $this->vehicle_maintenances = new VehicleMaintenanceModel();
        $this->isedit = $isEdit;
    }
    public function create()
    {
        $this->initializeModel(false);
    }
    public function cancel()
    {
        $this->resetValidation();
        $this->initializeModel(false);
    }
    public function getId($id = null, $isedit = null)
    {
        $this->isedit = $isedit;
        $this->vehicle_maintenance_id = $id;
        $this->vehicle_maintenances = VehicleMaintenanceModel::findOrFail($id);
    }
    public function delete()
    {
        $this->vehicle_maintenances->delete();
        UIHelper::flashMessage($this, 'Delete Successful', 'Vehicle maintenance deleted.', 'text-success');
    }

    public function save()
    {
        /*   if(!Gate::allows('allow-create','module-fleet-management')){
              UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
              $this->emit('close-modal');
              return;
          } */
        try {
            $this->validate();
            $this->vehicle_maintenances->created_by_id = auth()->user()->id;
            $this->vehicle_maintenances->last_updated_by_id = auth()->user()->id;
            $this->vehicle_maintenances->save();
            UIHelper::flashMessage($this, 'Saving Successful', 'Maintenance details updated.', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
        $this->emit('close-modal');
    }
}
