<?php

namespace App\Http\Livewire\Settings\User;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Registered;
use App\Helpers\UIHelper;
use App\Traits\Sortable;
use App\Models\User;

class UserList extends Component
{
    use WithPagination, Sortable;

    protected $paginationTheme='bootstrap';

    public $search = '';
    public $displaypage = 10;
    private $selectedID;
    public $isedit = false;
    public User $user;
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email|max:255|unique:users,email,'. $this->user->id .'',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:password',
            'user.contact_number' => 'string|max:30',
            'user.user_type' => 'required|integer',
        ];
    }
    public function mount()
    {

        if(!Gate::allows('allow-view','module-user-management')) redirect()->route('home');
    }
    public function create()
    {
        $this->user = new User();
        $this->user->contact_number = '';
        $this->password = null;
        $this->password_confirmation = null;
        $this->isedit = true;
    }
    public function cancel()
    {
        if($this->isedit == true)
        {
            $this->resetValidation();
            $this->isedit = false;
            $this->user = new User();
            $this->password = null;
            $this->password_confirmation = null;
        }
    }
    public function updatedUserUserType(){
        if($this->user->user_type < 2) $this->user->user_category = 0;
    }

    public function updatingSearch()
    {
        //Reset page on when updating search
        $this->resetPage();
    }

    public function updatingDisplaypage()
    {
        //Reset page on when updating displaypage
        $this->resetPage();
    }

    // Mark user for deletion.
    public function markDelete($id)
    {
        $this->user = User::findOrFail($id);
    }

    // Delete user.
    public function delete()
    {
        if(!Gate::allows('allow-delete','module-user-management')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            $this->emit('close-modal');
            return;
        }
        try
        {
            $this->user->delete();
            UIHelper::flashMessage($this,'Delete Successful','User deleted.','text-success');
            $this->user = new User();
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

    // Save user
    public function save()
    {
        if(!Gate::allows('allow-create','module-user-management')){
            UIHelper::flashMessage($this,'Action Cancelled','Unable to perform action due to user is unauthorized.','text-danger');
            $this->emit('close-modal');
            return;
        }
        try
        {
            $this->user->date_created = now();
            $this->user->date_updated = now();
            $this->user->created_by_id = auth()->user()->id;
            $this->user->last_updated_by_id = auth()->user()->id;
            $this->validate();
            $this->user->password = Hash::make($this->password);
            $this->user->is_active = true;
            $this->user->user_access = '';
            $this->user->save();
            //event(new Registered($this->user)); //Enable when email is set up
            redirect()->route('user-details',['id' => $this->user->id]);
        }
        catch(QueryException $e)
        {
            UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
            $this->emit('close-modal');
            $this->password = null;
            $this->password_confirmation = null;
        }
    }
    public function render()
    {
        $users = User::when(auth()->user()->user_type > 1, function($q){
            return $q->where('user_type','>',1)
                    ->whereNot('id',auth()->user()->id);
        })
        ->where(function($q){
            return $q->where('name','like','%'.$this->search.'%')
            ->orWhere('email','like','%'.$this->search.'%');
        })
        ->when($this->sortdirection != '', function ($q) {
            return $q->orderBy($this->sortby,$this->sortdirection);
        })
        ->paginate($this->displaypage);
        return view('livewire.settings.user.user-list',['users' => $users])
        ->layout('layouts.app');
    }
}
