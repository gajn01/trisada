<?php

namespace App\Http\Livewire\Settings\User;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use App\Models\NonDBModel\UserAccess;
use App\Helpers\UIHelper;
use Auth;

class UserDetails extends Component
{
    public User $user;
    public $useraccess;
    public $usertype;
    public $isactive;
    public $isedit = false;
    public $sameUser = false;
    public $selectedDepartment;
    public $usercategory;
    private $allowUserAccessUpdate;
    public $moduleList = [
        ['module' => "module-reservation",'module_name' => "Reservation Module",'access_type' => 0,'parent' => null,'description' => 'Access reservation module.'],
        ['module' => "module-reservation-approval",'module_name' => "Reservation Approval",'access_type' => 0,'parent' => 'module-reservation','description' => 'Allow declining and approval of reservation.'],
        ['module' => "module-reservation-pre-approval",'module_name' => "Reservation Pre-Approval",'access_type' => 0,'parent' => 'module-reservation','description' => 'Allow pre-approval of reservation of Department.'],
        ['module' => "module-trip-ticket",'module_name' => "Trip Ticket Management",'access_type' => 0,'parent' => null,'description' => 'Access trip ticket management.'],
        ['module' => "module-trip-ticket-cancellation",'module_name' => "Trip Ticket Cancellation",'access_type' => 0,'parent' => 'module-trip-ticket','description' => 'Allow cancellation of trip ticket.'],
        ['module' => "module-trip-ticket-releasing",'module_name' => "Vehicle Releasing",'access_type' => 0,'parent' => 'module-trip-ticket','description' => 'Allow releasing of vehicle.'],
        ['module' => "module-trip-ticket-closing",'module_name' => "Trip Ticket Closing",'access_type' => 0,'parent' => 'module-trip-ticket','description' => 'Allow closing of trip ticket.'],
        ['module' => "module-fleet-management",'module_name' => "Fleet Management",'access_type' => 1,'parent' => null,'description' => 'Access fleet management.'],
        ['module' => "module-fleet-lto-or",'module_name' => "LTO Registration Details (OR)",'access_type' => 1,'parent' => 'module-fleet-management','description' => 'Manage LTO registration details (OR).'],
        ['module' => "module-fleet-maintenance",'module_name' => "Fleet Maintenance",'access_type' => 1,'parent' => null,'description' => 'Manage fleet maintenance.'],
        ['module' => "module-driver-management",'module_name' => "Driver Management",'access_type' => 1,'parent' => null,'description' => 'Manage drivers.'],
        ['module' => "module-departments",'module_name' => "Department Settings",'access_type' => 1,'parent' => null,'description' => 'Access department settings.'],
        ['module' => "module-trip-categories",'module_name' => "Trip Categories Settings",'access_type' => 1,'parent' => null,'description' => 'Access trip category settings.'],
        ['module' => "module-vehicle-types",'module_name' => "Vehicle Type Settings",'access_type' => 1,'parent' => null,'description' => 'Access vehicle types settings.'],
        ['module' => "module-user-management",'module_name' => "User Management",'access_type' => 1,'parent' => null,'description' => 'Manage users.'],
        ['module' => "module-reset-password",'module_name' => "Reset Password",'access_type' => 0,'parent' => "module-user-management",'description' => 'Reset user password.'],
        ['module' => "module-set-status",'module_name' => "Set Status",'access_type' => 0,'parent' => "module-user-management",'description' => 'Set user status to active/inactive.'],
        ['module' => "module-override-email-verification",'module_name' => "Override Email Verifcation",'access_type' => 0,'parent' => "module-user-management",'description' => 'Override user email verification.'],
        ['module' => "module-set-access-scope",'module_name' => "Set Access Scope",'access_type' => 0,'parent' => "module-user-management",'description' => 'Set access scope.'],
        ['module' => "module-set-module-access",'module_name' => "Set Module Access",'access_type' => 0,'parent' => "module-user-management",'description' => 'Set module access.'],
        ['module' => "module-transaction",'module_name' => "Transaction Type Settings",'access_type' => 1,'parent' => null,'description' => 'Access Transaction Type.'],
        ['module' => "module-routes",'module_name' => "Routes Look Up Settings",'access_type' => 1,'parent' => null,'description' => 'Manage Route Look Up.'],
        ['module' => "module-tariff",'module_name' => "Tariff Settings",'access_type' => 1,'parent' => null,'description' => 'Manage Tariff.'],
        ['module' => "module-dashboard",'module_name' => "Dashboard",'access_type' => 1,'parent' => null,'description' => 'Dashboard Access.'],
        ['module' => "module-settings",'module_name' => "Settings",'access_type' => 0,'parent' => null,'description' => 'Access Settings.'],
    ];
    protected function rules()
    {
        return [
            'isactive' => 'boolean',
            'user.name' => 'required|string|max:255',
            'usertype' => 'required|integer',
            'user.email' => 'required|email|max:255|unique:users,email,'. $this->user->id .'',
            'user.contact_number' => 'string|max:30',
        ];
    }

    private function loadUserAccess(){
        $this->useraccess = null;
        $ua = $this->user->userAccessArray;
        foreach($this->moduleList as $module){
            $key = is_null($ua) == false && empty($ua) == false ? array_search($module['module'], array_column($ua, 'module')) : FALSE;
            if($key === FALSE){
                $access = new UserAccess();
                $access->module = $module['module'];
                $access->enabled = false;
                $access->access_level = 0;
                $access->access_type = $module['access_type'];
                $this->useraccess[] = $access;
            }else{
                $this->useraccess[] = $ua[$key];
            }
        }
    }

    public function mount($id){
        if(!Gate::allows('allow-view','module-user-management')) redirect()->route('home');
        $this->user = User::findOrFail($id);
        if(auth()->user()->user_type >1 && $this->user->id == auth()->user()->id) redirect()->route('home');
        $this->isactive = $this->user->is_active;
        $this->usertype = $this->user->user_type;
        $this->sameUser = Auth::user()->id == $this->user->id ? true : false;
        $this->loadUserAccess();
    }

    public function edit()
    {
        if($this->usertype == 0 && $this->sameUser == false){
            UIHelper::flashMessage($this,'Unauthorized Action','Cannot edit Super User account.','text-danger');
            return;
        }
        $this->isedit = true;
    }

    public function cancel()
    {
        $this->isedit = false;
        $this->user = User::findOrFail($this->user->id);
        $this->isactive = $this->user->is_active;
        $this->usertype = $this->user->user_type;
    }

    public function updatedUsertype()
    {

        if($this->usertype < 2 && $this->isedit == true) $this->usercategory = 0;
    }

    public function updatingUseraccess()
    {
        $this->allowUserAccessUpdate = Gate::allows('access-enabled','module-set-module-access');
    }

    public function updatedUseraccess()
    {
        if($this->allowUserAccessUpdate == false){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        $this->user->user_access = json_encode($this->useraccess);

        $this->user->save();
        $this->user->refresh();
        $this->loadUserAccess();
        UIHelper::flashMessage($this,'Update Successful','User access updated.','text-success');
    }

    public function updatedIsactive()
    {
        if(!Gate::allows('access-enabled','module-set-status')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        if($this->sameUser == true)
        {
            UIHelper::flashMessage($this,'Error','Cannot deactivate own account.','text-danger');
            $this->isactive = true;
            return;
        }
        if($this->user->user_type == 0)
        {
            UIHelper::flashMessage($this,'Error','Cannot deactivate Super User account.','text-danger');
            $this->isactive = true;
            return;
        }
        try{
            $this->validate();
            $editUser = User::findOrFail($this->user->id);
            $editUser->is_active = $this->isactive;
            $editUser->date_updated = now();
            $editUser->last_updated_by_id = auth()->user()->id;
            $editUser->save();
            $this->user->refresh();
            $this->isactive = $this->user->is_active;
            $this->usertype = $this->user->user_type;
            $this->sameUser = Auth::user()->id == $this->user->id ? true : false;
            $this->loadUserAccess();
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }
    }

    public function save()
    {
        if(!Gate::allows('allow-edit','module-user-management')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            $this->emit('close-modal');
            return;
        }
        try
        {
            $this->validate();
            $editUser = User::findOrFail($this->user->id);
            if($editUser->email != $this->user->email) $editUser->email_verified_at = null;
            $editUser->last_updated_by_id = auth()->user()->id;
            $editUser->name = $this->user->name;
            $editUser->email = $this->user->email;
            $editUser->user_type = $this->usertype;
            $editUser->contact_number = $this->user->contact_number;
            $editUser->save();
            $this->user->refresh();
            $this->sameUser = Auth::user()->id == $this->user->id ? true : false;
            $this->isactive = $this->user->is_active;
            $this->usertype = $this->user->user_type;
            $this->loadUserAccess();
            UIHelper::flashMessage($this,'Update Successful','User account details updated.','text-success');
            $this->isedit = false;
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }

    }

    public function overrideEmailVerification()
    {
        if(!Gate::allows('access-enabled','module-override-email-verification')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            $this->emit('close-modal');
            return;
        }

        try
        {
            $editUser = User::findOrFail($this->user->id);
            $editUser->last_updated_by_id = auth()->user()->id;
            $editUser->email_verified_at = now();
            $editUser->save();
            $this->user->refresh();
            $this->sameUser = Auth::user()->id == $this->user->id ? true : false;
            $this->isactive = $this->user->is_active;
            $this->usertype = $this->user->user_type;
            $this->user->refresh();
            UIHelper::flashMessage($this,'Update Successful','E-mail verification override successful.','text-success');
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }
    }

    public function resetPassword()
    {
        if(!Gate::allows('access-enabled','module-reset-password')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        }
        try
        {
            $editUser = User::findOrFail($this->user->id);
            if($editUser->user_type == 0 && $this->sameUser == false){
                UIHelper::flashMessage($this,'Unauthorized Action','Cannot reset Super User password.','text-danger');
                return;
            }

            $editUser->password = Hash::make("Password123");
            $editUser->save();
            $this->user->refresh();
            UIHelper::flashMessage($this,'Password Reset Successful','Password was reset to "Password123".','text-success');
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }
    }

    public function addDepartment()
    {
        if(!Gate::allows('access-enabled','module-set-access-scope')){
            $this->flashMessage('Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        } 
        try{
            $this->user->refresh();
            $this->validate(['selectedDepartment' => 'required|integer']);
            $existing = User::withCount(['departments' => function ($q){
                $q->where('department_id',$this->selectedDepartment);
            }])->where('id',$this->user->id)->first();

            if($existing->departments_count > 0){
                UIHelper::flashMessage($this,'Error','Department already added.','text-danger');
                return;
            }
            $this->user->departments()->attach($this->selectedDepartment);
            $this->user->last_updated_by_id = auth()->user()->id;
            $this->user->save();
            $this->user->refresh();
            UIHelper::flashMessage($this,'Saving Successful','Added department to access scope.','text-success');
            $this->selectedDepartment = null;
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }

    }

    public function removeDepartment($id)
    {
        if(!Gate::allows('access-enabled','module-set-access-scope')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            return;
        } 
        try
        {
            $this->user->refresh();
            $this->user->departments()->detach($id);
            $this->user->last_updated_by_id = auth()->user()->id;
            $this->user->save();
            $this->user->refresh();
            UIHelper::flashMessage($this,'Remove Successful','Removed department from access scope.','text-success');
            $this->selectedDepartment = null;
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
        }

    }

    public function render()
    {
        $departments = Department::get();
        return view('livewire.settings.user.user-details',['departments' => $departments]);
    }
}
