<?php

namespace App\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $username,$password;
    protected function rules()
    {
        return [
            'username' => 'required|integer',
            'password' => 'required',
        ];
    }
    public function render()
    {
        return view('livewire.login')->extends('components.layouts.guest');
    }
    public function save(){
        $this->validate();
        // dd($this->validate());
    }

}
