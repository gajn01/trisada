<?php
namespace App\Http\Livewire\Settings\Transaction;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use App\Models\Transaction;
use App\Helpers\UIHelper;

class TransactionDetails extends Component
{
    public $isedit = false;
    public $reservationDetails;
    public Transaction $transactionType;
    protected function rules()
    {
        return [
            'transactionType.type' => 'required|string|max:30',
            'transactionType.area' => 'required|string|max:30',
            'transactionType.concatenate' => 'required|string|max:30',
            'transactionType.scheme' => 'required|string|max:30',
            'transactionType.route_code' => 'required|string|max:30',
            // 'transactionType.stores' => 'required|string|max:200',
            'transactionType.km_travelled' => 'required|numeric', 
            'transactionType.liters' => 'required|numeric',
            'transactionType.fuel' => 'required|numeric',
            'transactionType.p_o' => 'nullable|numeric',
            'transactionType.fuel_cash_request' => 'nullable|numeric', 
            'transactionType.salary' => 'nullable|numeric', 
            'transactionType.food_allowance' => 'nullable|numeric', 
            'transactionType.parking' => 'nullable|numeric', 
            'transactionType.easytrip' => 'nullable|numeric', 
            'transactionType.autosweep' => 'nullable|numeric', 
            'transactionType.toll_fee' => 'nullable|numeric', 
        ];
    }
    public function render()
    {
        return view('livewire.settings.transaction.transaction-details');
    }
    public function mount($id)
    {
        if (!Gate::allows('allow-view', 'module-transactions'))
            redirect()->route('home');
        $this->transactionType = Transaction::findOrFail($id);
    }
   
    public function edit()
    {
        $this->isedit = true;
    }
    public function cancel()
    {
        $this->isedit = false;
    }
    public function save()
    {
        if (!Gate::allows('allow-edit', 'module-transactions')) {
            UIHelper::flashMessage($this, 'Action Cancelled', 'Unable to perform action due to user is unauthorized.', 'text-danger');
            return;
        }
        try {
            $this->validate();
            $this->transactionType->last_updated_by_id = auth()->user()->id;
            $this->transactionType->save();
            UIHelper::flashMessage($this, 'Update Successful', 'Routes updated.', 'text-success');
            $this->isedit = false;
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
}