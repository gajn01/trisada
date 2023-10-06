<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;


class CustomerList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public Customer $customer;
    public $displayPage = 10;

    public function render()
    {
        $customerList = $this->getDataList();
        return view('livewire.customer.customer-list',['customerList' => $customerList]);
    }
    public function getDataList(){
        return Customer::paginate($this->displayPage);
    }
}
