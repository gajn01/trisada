<?php

namespace App\Http\Livewire\Admin;

use App\Helpers\UIHelper;
use App\Models\Toda;
use App\Models\User;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;


class AdminList extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $displayPage = 10;
    public User $user;
    public $todaList;
    public $photo;

    protected function rules(){
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
            'user.status' => 'int', // Minimum 8 characters for the password.
            'user.toda_id' => 'int', // Minimum 8 characters for the password.
        ];
    }
    public function mount(){
        $this->user = new User;
        $this->todaList = $this->getTodaList();
    }
    public function render()
    {
        $accountList = $this->getAccountList();
        return view('livewire.admin.admin-list', ['accountList' => $accountList]);
    }
    public function getAccountList()
    {
        return User::where('user_type', 1)->paginate($this->displayPage);
    }
    public function getTodaList(){
        return Toda::get();
    }
    public function onCancel()
    {
        $this->resetValidation();
        $this->user = new User;
    }
    public function onSave(){

        try {

            $this->validate([
                'photo' => 'image|max:5024', // 1MB Max
            ]);
            $savedImage = $this->photo->store('img', 'public');

            $this->user->img = $savedImage ;
            $this->user->user_type = 1;
            $this->user->status = 1;
            $this->user->password = Hash::make($this->user->password);
            $this->user->created_at = now();
            $this->user->updated_at = now();
            $this->user->save();
            $this->emit('close-modal');
            UIHelper::flashMessage($this, 'Register Successful', 'Added new Admin', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }

    }

    public function onGetId($id)
    {
        $this->user = User::findOrFail($id);
    }
    public function onDelete()
    {
        try {
            $this->user->delete();
            UIHelper::flashMessage($this, 'Delete Successful', 'Account deleted.', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
}
