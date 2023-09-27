<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Helpers\UIHelper;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
class ChangePassword extends Component
{
    public $current_password,$new_password,$confirm_password;

    protected function rules()
    {
        return [
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!\Hash::check($value, auth()->user()->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ],
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ];
    }
    
    public function render()
    {
        return view('livewire.auth.change-password');
    }
    public function onChangePassword()
    {
        try {
            $this->validate();
            User::find(auth()->user()->id)
                ->update([
                    'password' => strip_tags(Hash::make($this->new_password)),
                ]);
            $this->resetValidation();
            $this->current_password = '';
            $this->new_password = '';
            $this->confirm_password = '';
            UIHelper::flashMessage($this, 'Success', 'Password successfully changed!', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }

}
