<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class AdminDetails extends Component
{
    public $isedit = false;
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
            'user.password' => 'string|min:8', // Minimum 8 characters for the password.
        ];
    }
    public function render()
    {
        return view('livewire.admin.admin-details');
    }
    public function mount($id){
        $this->user = User::find($id);
    }
    public function onUpdateOrCancel(){
        $this->isedit = !$this->isedit;
    }
}
