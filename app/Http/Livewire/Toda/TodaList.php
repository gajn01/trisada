<?php

namespace App\Http\Livewire\Toda;
use Illuminate\Database\QueryException;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use App\Models\Toda;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class TodaList extends Component
{
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';
    public $displaypage = 10;
    public $search = '';
    public $isedit = false;
    public Toda $toda;
    protected function rules()
    {
        return [
            'toda.toda_name' => 'required|string',
            'toda.toda_address' => 'required|string',
        ];
    }
    public function mount(){
        $this->toda = new Toda;
    }
    public function render()
    {
        $todaList = $this->getTodaList();
        return view('livewire.toda.toda-list',['todaList' => $todaList]);
    }
    public function getTodaList(){
        return Toda::where(function ($query){
             $query->where('toda_name', 'like', '%' . $this->search . '%');
        }
        )->paginate($this->displaypage);
    }
    public function onCancel(){
        $this->resetValidation();
        $this->toda = new Toda;
        $this->isedit = false;
    }
    public function onSave(){
        
        try {
            $this->validate();
            $this->toda->created_at = now();
            $this->toda->updated_at = now();
            $this->toda->save();
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
        $this->toda = Toda::findOrFail($id);
    }
    public function onDelete(){
        try {
            $this->toda->delete();
            UIHelper::flashMessage($this, 'Delete Successful', 'Toda deleted.', 'text-success');
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
}
