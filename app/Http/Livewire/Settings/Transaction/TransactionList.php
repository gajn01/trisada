<?php

namespace App\Http\Livewire\Settings\Transaction;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Models\Transaction;
use App\Helpers\UIHelper;

class TransactionList extends Component
{
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';
    public $isedit = false, $search = '';
    public $displaypage = 10;
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
            'transactionType.km_travelled' => 'required|numeric', // Use 'integer' instead of 'decimal'
            'transactionType.liters' => 'required|numeric',
            'transactionType.fuel' => 'required|numeric',
            'transactionType.p_o' => 'nullable|numeric',
            'transactionType.fuel_cash_request' => 'nullable|numeric', // Add parameters if necessary
            'transactionType.salary' => 'nullable|numeric', // Add parameters if necessary
            'transactionType.food_allowance' => 'nullable|numeric', // Add parameters if necessary
            'transactionType.parking' => 'nullable|numeric', // Add parameters if necessary
            'transactionType.easytrip' => 'nullable|numeric', // Add parameters if necessary
            'transactionType.autosweep' => 'nullable|numeric', // Add parameters if necessary
            'transactionType.toll_fee' => 'nullable|numeric', // Add parameters if necessary
        ];
    }
    public function mount()
    {
        if (!Gate::allows('allow-view', 'module-transaction'))redirect()->route('home');
        // $this->authorize('allow-view', 'module-transaction');
    }
    public function render()
    {
        $transactions = Transaction::where(fn($q) =>
            $q->where('type', 'like', '%' . $this->search . '%'))
            ->when($this->sortdirection != '', fn($q) => $q->orderBy($this->sortby, $this->sortdirection))
            ->paginate($this->displaypage);
        return view('livewire.settings.transaction.transaction-list',['transactions' => $transactions]);
    }
    public function create()
    {
        $this->transactionType = new Transaction();
        $this->isedit = true;
    }
    public function markDelete($id)
    {
        $this->transactionType = Transaction::findOrFail($id);
    }
    public function cancel()
    {
        if ($this->isedit == true) {
            $this->resetValidation();
            $this->isedit = false;
            $this->transactionType = new Transaction();
        }
    }
    public function save()
    {
       $this->validateAccess();
        try {
            $this->validate();
            $this->transactionType->created_by_id = auth()->user()->id;
            $this->transactionType->last_updated_by_id = auth()->user()->id;
            $this->transactionType->save();
            // redirect()->route('transactions-details', ['id' => $this->transactionType->id]);
            UIHelper::flashMessage($this,'Create Successful','Routes saved.','text-success');
            $this->emit('close-modal');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
            $this->emit('close-modal');
        }
    }
    public function delete()
    {
       $this->validateAccess();
        try
        {
            $this->transactionType->delete();
            UIHelper::flashMessage($this,'Delete Successful','Routes deleted.','text-success');
            $this->transactionType = new Transaction();
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
    public function validateAccess(){
        if (!Gate::allows('allow-create', 'module-transaction')) {
            UIHelper::flashMessage($this, 'Action Cancelled', 'Unable to perform action due to user is unauthorized.', 'text-danger');
            $this->emit('close-modal');
            return;
        }
    }
}