<?php

namespace App\Http\Livewire\Driver;

use App\Models\Driver as DriverModels;
use App\Models\Department as DepartmentModels;
use Livewire\Component;
use Illuminate\Database\QueryException;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use Illuminate\Support\Facades\Gate;

class DriverList extends Component
{
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';
    public $driver_id;
    public $displaypage = 10;
    public $search = '';
    public $isedit = false;
    public $department_list;
    public $is_logistic = false;
    public DriverModels $drivers;
    protected function rules()
    {
        return [
            'drivers.name' => 'required|string|max:50',
            'drivers.employee_id' => 'required|int',
            'drivers.department_id' => 'required_if:is_logistic,false|nullable|int'
        ];
    }
    protected $validationAttributes = [
        'drivers.name' => 'Driver Name',
        'drivers.employee_id' => 'Employee id',
    ];
    public function mount()
    {
        if (!Gate::allows('allow-view', 'module-driver-management')) redirect()->route('home');
        $this->department_list = DepartmentModels::get();
    }
    private function initializeModel($isEdit)
    {
        $this->drivers = new DriverModels();
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
        $this->driver_id = $id;
        $this->drivers = DriverModels::findOrFail($id);
        $this->is_logistic = $this->drivers->department_id ? false : true;
    }
    public function save()
    {
/*           if(!Gate::allows('allow-create','module-driver-management')){
              UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
              $this->emit('close-modal');
              return;
          } */
        try {
            $this->validate();
            $this->drivers->created_by_id = auth()->user()->id;
            $this->drivers->last_updated_by_id = auth()->user()->id;
            $this->drivers->save();
            UIHelper::flashMessage($this, 'Saving Successful', 'Driver details updated.', 'text-success');
            $this->emit('close-modal');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
            $this->emit('close-modal');
        }
    }
    public function delete()
    {
        if(!Gate::allows('allow-delete','module-driver-management')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        $this->drivers->delete();
        UIHelper::flashMessage($this, 'Delete Successful', 'Vehicle maintenance deleted.', 'text-success');
    }
    public function changeDepartment(){
        $this->drivers->department_id = $this->is_logistic ? null : $this->drivers->department_id  ;
    }
    public function render()
    {
        $driver = DriverModels::where(function ($subQuery) {
            $subQuery->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('employee_id', 'like', '%' . $this->search . '%');
        })
            ->when($this->sortdirection != '', function ($q) {
                return $q->orderBy($this->sortby, $this->sortdirection);
            })
            ->paginate($this->displaypage);
        return view('livewire.driver.driver-list', ['driver_list' => $driver]);
    }
}
