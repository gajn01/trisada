<?php

namespace App\Http\Livewire\Terminal;
use Illuminate\Database\QueryException;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use App\Models\Terminal;
use App\Models\Toda;
use Livewire\Component;

class TerminalList extends Component
{
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';
    public $displaypage = 10;
    public $search = '';
    public $isedit = false;
    public Terminal $terminal;
    public $todaList;
    public $toda_id;
    public function render()
    {
        $terminalList = $this->getDataList();
        return view('livewire.terminal.terminal-list',['terminalList'=>$terminalList]);
    }
     protected function rules()
    {
        return [
            'terminal.toda_id' => 'required',
            'terminal.terminal_name' => 'required|string',
            'terminal.terminal_address' => 'required|string',
            'terminal.terminal_long' => 'required|string',
            'terminal.terminal_lat' => 'required|string',
        ];
    }
    public function mount(){
        $this->terminal = new Terminal;
        $this->todaList = Toda::get();
    }
   
    public function getDataList(){
        return Terminal::where(function ($query){
             $query->where('terminal_name', 'like', '%' . $this->search . '%');
        })
      /*   ->when(auth()->user()->user_type != 0 ,function ($query){
            $query->find(auth()->user()->toda_id);
        }) */
        ->paginate($this->displaypage);
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
                UIHelper::flashMessage($this, 'Update Successful', 'Toda Updated', 'text-success');
            }else{
                UIHelper::flashMessage($this, 'Create Successful', 'Add Toda', 'text-success');
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
            UIHelper::flashMessage($this, 'Delete Successful', 'Toda deleted.', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
}
