<?php

namespace App\Http\Livewire\Settings\Department;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Models\Department;
use App\Helpers\UIHelper;

class DepartmentList extends Component
{
    use WithPagination, Sortable;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $displaypage = 10;
    private $selectedID;
    public $isedit = false;
    public Department $department;

    protected function rules()
    {
        return [
            'department.code' => 'required|string|max:10|unique:departments,code,' . $this->department->id . '',
            'department.name' => 'required|string|max:50',
            'department.description' => 'string',
        ];
    }

    public function boot()
    {

    }

    public function mount()
    {
        if (!Gate::allows('allow-view', 'module-departments'))
            redirect()->route('home');
    }

    public function create()
    {
        $this->department = new Department();
        $this->department->description = '';
        $this->isedit = true;
    }

    public function cancel()
    {
        if ($this->isedit == true) {
            $this->resetValidation();
            $this->isedit = false;
            $this->department = new Department();
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
        $this->department = Department::findOrFail($id);
    }

    public function delete()
    {
        if (!Gate::allows('allow-delete', 'module-departments')) {
            UIHelper::flashMessage($this, 'Action Cancelled', 'Unable to perform action due to user is unauthorized.', 'text-danger');
            return;
        }
        try {
            $this->department->delete();
            UIHelper::flashMessage($this, 'Delete Successful', 'Deparment deleted.', 'text-success');
            $this->department = new Department();
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                UIHelper::flashMessage($this, 'Action Cancelled', 'Cannot delete record with transactions.', 'text-danger');
            } else {
                UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
            }
        }
    }

    public function save()
    {
        if (!Gate::allows('allow-create', 'module-departments')) {
            UIHelper::flashMessage($this, 'Action Cancelled', 'Unable to perform action due to user is unauthorized.', 'text-danger');
            $this->emit('close-modal');
            return;
        }
        try {
            $this->validate();
            $this->department->created_by_id = auth()->user()->id;
            $this->department->last_updated_by_id = auth()->user()->id;
            $this->department->save();
            redirect()->route('department-details', ['id' => $this->department->id]);
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
            $this->emit('close-modal');
        }

    }

    public function render()
    {
        $departments = Department::where(function ($q) {
            return $q->where('code', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        })
            ->when($this->sortdirection != '', function ($q) {
                return $q->orderBy($this->sortby, $this->sortdirection);
            })
            ->paginate($this->displaypage);

        return view('livewire.settings.department.department-list', ['departments' => $departments]);
    }
}
