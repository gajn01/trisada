<?php

namespace App\Http\Livewire\Driver;

use App\Models\Driver;
use App\Models\User;
use Livewire\Component;
use App\Helpers\UIHelper;
use Illuminate\Database\QueryException;

class DriverDetails extends Component
{
    public $isedit = false;
    public Driver $driver;
    public User $user;

    protected function rules()
    {
        return [
            'user.user_id' => 'string',
            'user.user_type' => 'string',
            'user.firstname' => 'string',
            'user.midname' => 'string',
            'user.lastname' => 'string',
            'user.contact_no' => 'integer',
            'user.address' => 'string',
            'user.email' => 'string',
            'user.img' => 'string',
            'user.age' => 'integer', // Assuming age is an integer.
            'user.birthday' => 'date',
            'user.username' => 'string', // Validate uniqueness in the 'users' table.
            'user.status' => 'int', // Minimum 8 characters for the password.
            'driver.driver_license' => 'string',
            'driver.plate_number' => 'string',
            'driver.franchise_no' => 'string',
            'driver.register_number' => 'string',
            'driver.or_cr' => 'string',
            'driver.toda_id' => 'integer', // Assuming toda_id is an integer.
        ];
    }
    public function render()
    {
        return view('livewire.driver.driver-details');
    }
    public function mount($id){
        $this->driver = new Driver;
        $this->driver = $this->getDeriverDetails($id);
        $this->user = $this->getUserDetails();

    }
    public function getDeriverDetails($id){
        return Driver::find($id);
    }
    public function getUserDetails(){
        return User::find($this->driver->user_id);
    }
    public function onUpdateOrCancel(){
        $this->isedit = !$this->isedit;
    }
    public function onSave(){
        try {
            $this->user->save();
            $this->driver->save();
            $this->driver->refresh();
            $this->user->refresh();
            $this->onUpdateOrCancel();
            UIHelper::flashMessage($this, 'Update Successful', 'Update Driver Details', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }

    }
}
