<?php

namespace App\Http\Livewire\Settings\Route;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Models\Route;
use App\Helpers\UIHelper;
class RouteList extends Component
{
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';
    public $isedit = false, $search = '';
    public $displaypage = 10;
    public Route $route;
    protected function rules()
    {
        return [
            'route.type' => 'required|string|max:30',
            'route.area' => 'required|string|max:30',
            'route.concatenate' => 'required|string|max:30',
            'route.scheme' => 'required|string|max:30',
            'route.route_code' => 'required|string|max:30',
            // 'route.stores' => 'required|string|max:200',
            'route.km_travelled' => 'required|numeric', // Use 'integer' instead of 'decimal'
            'route.liters' => 'required|numeric',
            'route.fuel' => 'required|numeric',
            'route.p_o' => 'nullable|numeric',
            'route.fuel_cash_request' => 'nullable|numeric', // Add parameters if necessary
            'route.salary' => 'nullable|numeric', // Add parameters if necessary
            'route.food_allowance' => 'nullable|numeric', // Add parameters if necessary
            'route.parking' => 'nullable|numeric', // Add parameters if necessary
            'route.easytrip' => 'nullable|numeric', // Add parameters if necessary
            'route.autosweep' => 'nullable|numeric', // Add parameters if necessary
            'route.toll_fee' => 'nullable|numeric', // Add parameters if necessary
        ];
    }
    public function mount()
    {
        if (!Gate::allows('allow-view', 'module-route'))redirect()->route('home');
        // $this->authorize('allow-view', 'module-transaction');
    }
    public function render()
    {
        $routeList = Route::where(fn($q) =>
        $q->where('type', 'like', '%' . $this->search . '%'))
        ->when($this->sortdirection != '', fn($q) => $q->orderBy($this->sortby, $this->sortdirection))
        ->paginate($this->displaypage);
        return view('livewire.settings.route.route-list',['routeList' => $routeList]);
    }
    public function create()
    {
        $this->route = new Route();
        $this->isedit = true;
    }
    public function markDelete($id)
    {
        $this->route = Route::findOrFail($id);
    }
    public function cancel()
    {
        if ($this->isedit == true) {
            $this->resetValidation();
            $this->isedit = false;
            $this->route = new Route();
        }
    }
    public function save()
    {
       $this->validateAccess();
        try {
            $this->validate();
            $this->route->created_by_id = auth()->user()->id;
            $this->route->last_updated_by_id = auth()->user()->id;
            $this->route->save();
            // redirect()->route('Routes-details', ['id' => $this->route->id]);
            UIHelper::flashMessage($this,'Create Successful','Routes saved.','text-success');
            $this->emit('close-modal');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
            $this->emit('close-modal');
        }
    }
    public function delete()
    {
       $this->validateAccess();
        try
        {
            $this->route->delete();
            UIHelper::flashMessage($this,'Delete Successful','Routes deleted.','text-success');
            $this->route = new Route();
        }
        catch(QueryException $e)
        {
            if($e->getCode() == 23000)
            {
                UIHelper::flashMessage($this,'Action Cancelled','Cannot delete record with routes.','text-danger');
            }else{
                UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
            }
        }
    }
    public function validateAccess(){
        if (!Gate::allows('allow-create', 'module-route')) {
            UIHelper::flashMessage($this, 'Action Cancelled', 'Unable to perform action due to user is unauthorized.', 'text-danger');
            $this->emit('close-modal');
            return;
        }
    }
}