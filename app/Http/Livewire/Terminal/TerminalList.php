<?php

namespace App\Http\Livewire\Terminal;
use Illuminate\Database\QueryException;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

/* model */
use App\Models\Toda;
use App\Models\Terminal;


class TerminalList extends Component
{  
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';
    public $displaypage = 10;
    public $search = '';
    public $isedit = false;
    public Terminal $terminal;
    public $todaList;
    protected function rules()
    {
        return [
            'terminal.toda_id' => 'required|integer',
            'terminal.terminal_name' => 'required|string',
            'terminal.terminal_address' => 'required|string',
        ];
    }
    public function mount(){
        $this->todaList = $this->getTodaList();
    }
    public function render()
    {   
        $terminalList = $this->getTerminalList();
        return view('livewire.terminal.terminal-list',['terminalList' => $terminalList]);
    }
    public function getTodaList(){
        return Toda::get();
    }
    public function getTerminalList(){
        return Terminal::where(function ($query){
             $query->where('terminal_name', 'like', '%' . $this->search . '%');
        }
        )->paginate($this->displaypage);
    }
    public function onCancel(){
        $this->resetValidation();
        $this->terminal = new Terminal;
        $this->isedit = false;
    }
    public function onSave(){
        
        try {
            $this->validate();
            $this->terminal->created_at = now();
            $this->terminal->updated_at = now();
            $this->terminal->save();
            $this->emit('close-modal');
            $this->resetValidation();
            if($this->isedit){
                UIHelper::flashMessage($this, 'Update Successful', 'Terminal Updated', 'text-success');
            }else{
                UIHelper::flashMessage($this, 'Create Successful', 'Add Terminal', 'text-success');
            }
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
    public function onGetId($id){
        $this->isedit = true;
        $this->terminal = Terminal::findOrFail($id);
    }
    public function onDelete(){
        try {
            $this->terminal->delete();
            UIHelper::flashMessage($this, 'Delete Successful', 'Terminal deleted.', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
}
