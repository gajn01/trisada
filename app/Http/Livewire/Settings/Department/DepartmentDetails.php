<?php

namespace App\Http\Livewire\Settings\Department;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use App\Models\Department;
use App\Helpers\UIHelper;

class DepartmentDetails extends Component
{
    public $isedit;
    public Department $department;

    protected function rules()
    {
        return [
            'department.code' => 'required|string|max:10|unique:departments,code,'. $this->department->id .'',
            'department.name' => 'required|string|max:50',
            'department.description' => 'string',
        ];
    }

    public function mount($id){
        if(!Gate::allows('allow-view','module-departments')) redirect()->route('home');
        $this->isedit = false;
        $this->department = Department::findOrFail($id);
    }

    public function edit()
    {
        $this->isedit = true;
    }

    public function cancel()
    {
        $this->isedit = false;
        $this->department = Department::findOrFail($this->department->id);
    }

    public function save()
    {
        if(!Gate::allows('allow-edit','module-departments')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        try
        {
            $this->validate();
            $this->department->last_updated_by_id = auth()->user()->id;
            $this->department->save();
            UIHelper::flashMessage($this,'Update Successful','Department details updated.','text-success');
            $this->isedit = false;
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }

    }

    public function render()
    {
        return view('livewire.settings.department.department-details');
    }
}
