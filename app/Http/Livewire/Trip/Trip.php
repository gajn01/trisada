<?php

namespace App\Http\Livewire\Trip;

use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Helpers\UIHelper;
use App\Models\TripTicket;
use App\Models\Department as DepartmentModel;


class Trip extends Component
{
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';
    public $displaypage = 10;
    public $search = '';
    public $status_filter, $department_filter, $transaction_filter, $ticket_date = '';
    public $department;

    public function mount()
    {
        if (!Gate::allows('allow-view', 'module-trip-ticket'))
            redirect()->route('home');
        $this->department = DepartmentModel::get();
    }
    public function render()
    {
        $trip = TripTicket::where(function ($query) {
            $query->whereHas('reservation', function ($subQuery) {
                $subQuery->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('id', 'like', '%' . $this->search . '%');
                $subQuery->when($this->department_filter != 'all' && $this->department_filter != '', function ($query) {
                    $query->where('department_id', $this->department_filter);
                });
            });
        })->when($this->status_filter != 'all' && $this->status_filter != '', function ($query) {
            $query->where('status', $this->status_filter);
        })->when($this->transaction_filter != 'all' && $this->transaction_filter != '', function ($query) {
            $query->where('transaction_type', $this->transaction_filter);
        })->when($this->ticket_date != 'all' && $this->ticket_date != '', function ($query) {
            $query->where('ticket_date', 'like', '%' . $this->ticket_date . '%');
        })->orderBy('status', 'asc')
            ->paginate($this->displaypage);
        return view('livewire.trip.trip', ['trip_ticket_list' => $trip]);
    }
}