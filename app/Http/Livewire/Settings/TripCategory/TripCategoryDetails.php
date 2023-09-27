<?php

namespace App\Http\Livewire\Settings\TripCategory;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use App\Models\TripCategory;
use App\Helpers\UIHelper;

class TripCategoryDetails extends Component
{
    public $isedit;
    public TripCategory $tripcategory;

    protected function rules()
    {
        return [
            'tripcategory.description' => 'required|string|max:100',
            'tripcategory.priority_level' => 'required|integer',
        ];
    }

    public function mount($id){
        if(!Gate::allows('allow-view','module-trip-categories')) redirect()->route('home');
        $this->isedit = false;
        $this->tripcategory = TripCategory::findOrFail($id);
    }

    public function edit()
    {
        $this->isedit = true;
    }

    public function cancel()
    {
        $this->isedit = false;
        $this->tripcategory = TripCategory::findOrFail($this->tripcategory->id);
    }

    public function save()
    {
        if(!Gate::allows('allow-edit','module-trip-categories')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        try
        {
            $this->validate();
            $this->tripcategory->last_updated_by_id = auth()->user()->id;
            $this->tripcategory->save();
            UIHelper::flashMessage($this,'Update Successful','Trip Category details updated.','text-success');
            $this->isedit = false;
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }

    }
    public function render()
    {
        return view('livewire.settings.trip-category.trip-category-details');
    }
}
