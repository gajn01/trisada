<?php
namespace App\Http\Livewire\Reservation;

use App\Models\Reservation;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use App\Traits\Sortable;
use App\Models\Department as DepartmentModel;

class ReservationList extends Component
{
    use WithPagination, Sortable;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $displaypage = 10;
    public $status_filter , $department_filter , $date_pickup_filter , $date_returned_filter = '';
    public $department;
    public function mount()
    {
        if (!Gate::allows('allow-view', 'module-reservation'))
            redirect()->route('home');
        $this->department = DepartmentModel::get();
    }
    public function render()
    {
        $reservation = $this->filteredReservation()
        ->when(auth()->user()->user_type > 1 && Gate::allows('access-enabled','module-reservation-approval') == false , function($q){
            $depIds = auth()->user()->departments->pluck('id');
            return $q->whereIn('department_id',$depIds);
        })->when(auth()->user()->user_type < 2,function($q){
            return $q->whereNot('status',0);
        })
        ->when($this->sortdirection != '', function ($q) {
            return $q->orderBy($this->sortby,$this->sortdirection);
        })->orderBy('status' , 'asc')
        ->paginate($this->displaypage);
        return view('livewire.reservation.reservation-list', ['reservations_list' => $reservation]);
    }
    public function getReservationList(){
        return Reservation::where(function ($query) {
            $query->whereHas('department', function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('code', 'like', '%' . $this->search . '%');
            })
            ->orWhere('destination', 'like', '%' . $this->search . '%');
        });
    }
    public function filteredReservation(){
        return $this->getReservationList()->when($this->status_filter != 'all' && $this->status_filter != '', function ($query) {
            $query->where('status', $this->status_filter);
        })
        ->when($this->department_filter != 'all' && $this->department_filter != '', function ($query) {
            $query->where('department_id', $this->department_filter);
        })
        ->when($this->date_pickup_filter != 'all' && $this->date_pickup_filter != '', function ($query) {
            $query->where('pickup_date', 'like', '%' . $this->date_pickup_filter . '%');
        })
        ->when($this->date_returned_filter != 'all' && $this->date_returned_filter != '', function ($query) {
            $query->where('return_date', 'like', '%' . $this->date_returned_filter . '%');
        });
    }
    public function onViewDisplay($id){
        redirect()->route('reservation-details', ['id' => $id]);  

    }
}