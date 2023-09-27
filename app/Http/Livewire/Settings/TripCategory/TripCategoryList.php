<?php

namespace App\Http\Livewire\Settings\TripCategory;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Models\TripCategory;
use App\Helpers\UIHelper;


class TripCategoryList extends Component
{
    use WithPagination, Sortable;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $displaypage = 10;
    private $selectedID;
    public $isedit = false;

    public TripCategory $tripcategory;

    protected function rules()
    {
        return [
            'tripcategory.description' => 'required|string|max:100',
            'tripcategory.priority_level' => 'required|integer',
        ];
    }

    public function mount()
    {
        if (!Gate::allows('allow-view', 'module-trip-categories'))
            redirect()->route('home');
    }

    public function create()
    {
        $this->tripcategory = new TripCategory();
        $this->tripcategory->description = '';
        $this->tripcategory->priority_level = 0;
        $this->isedit = true;
    }

    public function cancel()
    {
        if ($this->isedit == true) {
            $this->resetValidation();
            $this->isedit = false;
            $this->tripcategory = new TripCategory();
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
        $this->tripcategory = TripCategory::findOrFail($id);
    }

    public function delete()
    {
        if (!Gate::allows('allow-delete', 'module-trip-categories')) {
            UIHelper::flashMessage($this, 'Action Cancelled', 'Unable to perform action due to user is unauthorized.', 'text-danger');
            return;
        }
        try {
            $this->tripcategory->delete();
            UIHelper::flashMessage($this, 'Delete Successful', 'Deparment deleted.', 'text-success');
            $this->tripcategory = new TripCategory();
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
        if (!Gate::allows('allow-create', 'module-trip-categories')) {
            UIHelper::flashMessage($this, 'Action Cancelled', 'Unable to perform action due to user is unauthorized.', 'text-danger');
            $this->emit('close-modal');
            return;
        }
        try {
            $this->validate();
            $this->tripcategory->created_by_id = auth()->user()->id;
            $this->tripcategory->last_updated_by_id = auth()->user()->id;
            $this->tripcategory->save();
            redirect()->route('trip-category-details', ['id' => $this->tripcategory->id]);
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
            $this->emit('close-modal');
        }

    }

    public function render()
    {
        $tripcategories = TripCategory::where(function ($q) {
            return $q->where('description', 'like', '%' . $this->search . '%');
        })
            ->when($this->sortdirection != '', function ($q) {
                return $q->orderBy($this->sortby, $this->sortdirection);
            })
            ->paginate($this->displaypage);

        return view('livewire.settings.trip-category.trip-category-list', ['tripcategories' => $tripcategories]);
    }

}
