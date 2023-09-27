<?php

namespace App\Http\Livewire\Fleet;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use App\Models\Vehicle;
use App\Models\LtoVehicleRegistration;
class SubLtoVehicleRegistration extends Component
{
    use WithPagination, Sortable;

    protected $paginationTheme='bootstrap';

    public $vehicleId;
    public LtoVehicleRegistration $registration;
    public $registrationId;
    public $displaypage = 10;
    public $selectedID;

    public $editMode = 0; //0 = none, 1 = create, 2 = edit

    protected function rules()
    {
        return [
            'registration.or_number' => 'required|string|max:50',
            'registration.or_date' => 'required|date',
            'registration.validity_date' => 'required|date|after:registration.or_date',
            'registration.renewal_start_date' => 'required|date',
            'registration.renewal_end_date' => 'required|date|after:registration.renewal_start_date',
        ];
    }

    protected $validationAttributes = [
        'registration.or_number' => 'OR number',
        'registration.or_date' => 'OR date',
        'registration.validity_date' => 'validity date',
        'registration.renewal_start_date' => 'renewal start date',
        'registration.renewal_end_date' => 'renewal end date',
    ];

    public function mount($id)
    {
        $this->vehicleId = $id;
        $this->editMode = 0;
    }

    public function createLTORegistration()
    {
        $this->registration = new LtoVehicleRegistration();
        $this->editMode = 1;
    }

    public function editLTORegistration($id)
    {
        $this->selectedId = $id;
        $this->registration = LtoVehicleRegistration::findOrFail($id);
        $this->editMode = 2;
    }
    
    public function save()
    {

        try
        {
            if($this->editMode == 1)
            {
                if(!Gate::allows('allow-create','module-fleet-lto-or')){
                    $this->emit('showToast','Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
                    $this->emit('close-modal');
                    return;
                }
                $this->validate();
                $this->registration->created_by_id = auth()->user()->id;
                $this->registration->last_updated_by_id = auth()->user()->id;
                $this->registration->vehicle_id = $this->vehicleId;
                $this->registration->save();
                $this->emit('showToast','Saving Successful','LTO vehicle registration details created.','text-success');
            }else{
                if(!Gate::allows('allow-edit','module-fleet-lto-or')){
                    $this->emit('showToast','Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
                    $this->emit('close-modal');
                    return;
                }
                $this->validate();
                $this->registration->last_updated_by_id = auth()->user()->id;
                $this->registration->save();
                $this->emit('showToast','Saving Successful','LTO vehicle registration details updated.','text-success');
            }

            $this->emit('close-modal');
            $this->editMode = 0;
        }
        catch(QueryException $e)
        {
            $this->emit('showToast','Error',$e->getMessage(),'text-danger');
        }
    }

    public function updatingDisplaypage()
    {
        //Reset page on when updating displaypage
        $this->resetPage();
    }

    // Mark user for deletion.
    public function markDelete($id)
    {
        $this->registrationId = $id;
    }

    // Delete user.
    public function delete()
    {
        if(!Gate::allows('allow-delete','module-user-management')){
            $this->emit('showToast','Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            $this->emit('close-modal');
            return;
        }
        try
        {
            LtoVehicleRegistration::findorFail($this->registrationId)->delete();
            $this->emit('showToast','Delete Successful','LTO vehicle registration details deleted.','text-success');
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
    public function cancel()
    {
        $this->registration = new LtoVehicleRegistration();
        $this->resetValidation();
        $this->editMode = 0;
    }

    public function render()
    {
        $registrations = LtoVehicleRegistration::where('vehicle_id',$this->vehicleId)->paginate($this->displaypage,['*'],'ltoRegistration');
        return view('livewire.fleet.sub-lto-vehicle-registration',['registrations' => $registrations]);
    }
}
