<?php

namespace App\Http\Livewire\Settings\Tarif;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use App\Models\Tarif;


class TarifList extends Component
{
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';
    public $isedit = false, $search = '';
    public $displaypage = 10;
    public Tarif $tarif;
    protected function rules()
    {
        return [
            'tarif.description' => 'required|string|max:50',
        ];
    }
    public function mount()
    {
        if (!Gate::allows('allow-view', 'module-tarif'))redirect()->route('home');
        // $this->authorize('allow-view', 'module-transaction');
    }
    public function render()
    {
        $tarifList = Tarif::where(fn($q) =>
        $q->where('description', 'like', '%' . $this->search . '%'))
        ->when($this->sortdirection != '', fn($q) => $q->orderBy($this->sortby, $this->sortdirection))
        ->paginate($this->displaypage);
        return view('livewire.settings.tarif.tarif-list',['tarifList' => $tarifList]);
    }
    public function create()
    {
        $this->tarif = new Tarif();
        $this->isedit = true;
    }
    public function markDelete($id)
    {
        $this->tarif = Tarif::findOrFail($id);
    }
    public function cancel()
    {
        if ($this->isedit == true) {
            $this->resetValidation();
            $this->isedit = false;
            $this->tarif = new Tarif();
        }
    }
    public function save()
    {
       $this->validateAccess();
        try {
            $this->validate();
            $this->tarif->created_by_id = auth()->user()->id;
            $this->tarif->last_updated_by_id = auth()->user()->id;
            $this->tarif->save();
            // redirect()->route('Routes-details', ['id' => $this->route->id]);
            UIHelper::flashMessage($this,'Create Successful','Tarif saved.','text-success');
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
            $this->tarif->delete();
            UIHelper::flashMessage($this,'Delete Successful','Tarif deleted.','text-success');
            $this->tarif = new Tarif();
        }
        catch(QueryException $e)
        {
            if($e->getCode() == 23000)
            {
                UIHelper::flashMessage($this,'Action Cancelled','Cannot delete record with Tarif.','text-danger');
            }else{
                UIHelper::flashMessage($this,'Error',$e->getMessage(),'text-danger');
            }
        }
    }
    public function validateAccess(){
        if (!Gate::allows('allow-create', 'module-tarif')) {
            UIHelper::flashMessage($this, 'Action Cancelled', 'Unable to perform action due to user is unauthorized.', 'text-danger');
            $this->emit('close-modal');
            return;
        }
    }
}
