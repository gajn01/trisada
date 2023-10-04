<?php

namespace App\Http\Livewire\Driver;

use Illuminate\Database\QueryException;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use Livewire\Component;
use App\Models\Driver;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

class DriverList extends Component
{
    use WithPagination, Sortable, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $displaypage = 10;
    public $search = '';
    public Driver $driver;
    public User $user;
    public $photo;
    public $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhZG1pbl9pZCI6IiIsInVzZXJuYW1lIjoic3VwZXJhZG1pbiIsImlhdCI6MTY5NjMyODkzMywiZXhwIjoxNzI3ODY0OTMzfQ.a_PViHssPWesB3_PRnFU8yWmH8mCJDCRRq-eh9bwErE';
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
            'driver.driver_license' => 'string',
            'driver.plate_number' => 'string',
            'driver.franchise_no' => 'string',
            'driver.register_number' => 'string',
            'driver.or_cr' => 'string',
            'driver.toda_id' => 'integer', // Assuming toda_id is an integer.
        ];
    }
    public function mount()
    {
        $this->user = new User;
        $this->driver = new Driver;
    }
    public function render()
    {
        $driverList = $this->getDataList();
        return view('livewire.driver.driver-list',['driverList'=>$driverList]);
    }
    public function getDataList()
    {
        /* return Driver::where(function ($query) {
            $query->where('terminal_name', 'like', '%' . $this->search . '%');
        })
        ->paginate($this->displaypage); */
        return Driver::get();
    }
    public function onCancel()
    {
        $this->resetValidation();
        $this->driver = new Driver;
    }
    public function onSave()
    {
        $this->validate([
            'photo' => 'image|max:5024', // 1MB Max
        ]);

        $savedImage = $this->photo->store('img', 'public');
        try {
            $this->validate();
            $this->user->user_id = 1;
            $this->user->user_type = 2;
            $this->user->img = $savedImage ;
            $this->user->created_at = now();
            $this->user->updated_at = now();
            $id = $this->user->save();

            $this->driver->uesr_id = $id;
            $this->driver->toda_id = 1;
            $this->driver->created_at = now();
            $this->driver->updated_at = now();
            $this->driver->save();
            // dd($this->user,$this->driver,$id);
         

            $this->emit('close-modal');
            $this->resetValidation();
            UIHelper::flashMessage($this, 'Register Successful', 'Added new driver', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
        /* $data = [
            [
                'user_accounts' => [
                    'firstname' => $this->user->firstname,
                    'midname' => $this->user->midname,
                    'lastname' => $this->user->lastname,
                    'contact_no' => $this->user->contact_no,
                    'img' => $savedImage,
                    'address' => $this->user->address,
                    'email' => $this->user->email,
                    'age' => $this->user->age,
                    'birthday' => $this->user->birthday,
                    'username' => $this->user->username,
                    'password' => $this->user->password,
                ],
                'driver_details' => [
                    'driver_license' => $this->driver->driver_license,
                    'plate_number' => $this->driver->plate_number,
                    'franchise_no' => $this->driver->franchise_no,
                    'register_number' => $this->driver->register_number,
                    'or_cr' => $this->driver->or_cr,
                    'toda_id' => $this->driver->toda_id ?? '',

                ]
            ]
        ];
        $response = Http::withHeaders([
            'Authorization' => $this->token,
            'Accept' => 'application/json', // Specify the desired content type
        ])->POST('https://wild-rose-toad-robe.cyclic.cloud/driver', $data);

        if ($response->successful()) {
            // Handle the successful response, e.g., store data in a property
            $apiData = $response->json();
            dd($apiData);
        } else {
            // Handle errors or failed responses here
            $errorMessage = 'Error: ' . $response->status();
            dd($errorMessage);
        } */
    }
    public function onGetId($id)
    {
        $this->driver = Driver::findOrFail($id);
    }
    public function onDelete()
    {
        try {
            $this->terminal->delete();
            UIHelper::flashMessage($this, 'Delete Successful', 'Toda deleted.', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
}
