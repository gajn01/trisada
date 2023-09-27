<?php

namespace App\Http\Livewire\Settings\Tarif;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use App\Models\Tarif;

class TarifDetails extends Component
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
    public function mount($id = null)
    {
        if (!Gate::allows('allow-view', 'module-tarif'))redirect()->route('home');
        $this->tarif = Tarif::findOrFail($id);

        // $this->authorize('allow-view', 'module-transaction');
    }
    public function render()
    {
        return view('livewire.settings.tarif.tarif-details');
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
        if (!Gate::allows('allow-edit', 'module-tarif')) {
            UIHelper::flashMessage($this, 'Action Cancelled', 'Unable to perform action due to user is unauthorized.', 'text-danger');
            return;
        }
        try {
            $this->validate();
            $this->tarif->last_updated_by_id = auth()->user()->id;
            $this->tarif->save();
            UIHelper::flashMessage($this, 'Update Successful', 'Tarif updated.', 'text-success');
            $this->isedit = false;
        } catch (QueryException $e) {
            UIHelper::flashMessage($this, 'Error', $e->getMessage(), 'text-danger');
        }
    }
}
