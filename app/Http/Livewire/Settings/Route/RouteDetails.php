<?php

namespace App\Http\Livewire\Settings\Route;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use App\Models\Route;
use App\Helpers\UIHelper;

class RouteDetails extends Component
{
    public $isedit = false;
    public $reservationDetails;
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
            'route.km_travelled' => 'required|numeric', 
            'route.liters' => 'required|numeric',
            'route.fuel' => 'required|numeric',
            'route.p_o' => 'nullable|numeric',
            'route.fuel_cash_request' => 'nullable|numeric', 
            'route.salary' => 'nullable|numeric', 
            'route.food_allowance' => 'nullable|numeric', 
            'route.parking' => 'nullable|numeric', 
            'route.easytrip' => 'nullable|numeric', 
            'route.autosweep' => 'nullable|numeric', 
            'route.toll_fee' => 'nullable|numeric', 
        ];
    }
    public function render()
    {
        return view('livewire.settings.route.route-details');
    }
    public function mount($id)
    {
        if (!Gate::allows('allow-view', 'module-route'))
            redirect()->route('home');
        $this->route = Route::findOrFail($id);
    }
   
    public function edit()
    {
        $this->isedit = true;
    }
    public function cancel()
    {
        $this->isedit = false;
    }
    public function save()
    {
        if (!Gate::allows('allow-edit', 'module-route')) {
            UIHelper::flashMessage($this, 'Action Cancelled', 'Unable to perform action due to user is unauthorized.', 'text-danger');
            return;
        }
        try {
            $this->validate();
            $this->route->last_updated_by_id = auth()->user()->id;
            $this->route->save();
            UIHelper::flashMessage($this, 'Update Successful', 'Routes updated.', 'text-success');
            $this->isedit = false;
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
}
