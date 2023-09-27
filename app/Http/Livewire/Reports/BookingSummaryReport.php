<?php

namespace App\Http\Livewire\Reports;

use App\Models\Reservation;
use Livewire\Component;
use Carbon\Carbon;

use Livewire\WithPagination;

class BookingSummaryReport extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $start_date;
    public $end_date;
    public Reservation $reservation;
    public $displaypage = 10;
    public $sortby;
    public $sortdirection;

    public function render()
    {
        $reservation_data = $this->getReservationByDate();
        return view('livewire.reports.booking-summary-report', ['reservation_data' => $reservation_data])->layout("layouts.report");
    }

    public function mount()
    {
        $defaultDateRange = Reservation::selectRaw('MIN(date_created) as min_date, MAX(date_created) as max_date')->first();
        $this->start_date = Carbon::parse($defaultDateRange->min_date)->format('Y-m-d');
        $this->end_date = Carbon::parse($defaultDateRange->max_date)->format('Y-m-d');
    }


    public function sort($sortby)
    {
        if ($this->sortby <> $sortby) $this->sortdirection = '';
        $this->sortby = $sortby;
        if ($this->sortdirection == '') {
            $this->sortdirection = 'asc';
        } elseif ($this->sortdirection == 'asc') {
            $this->sortdirection = 'desc';
        } else {
            $this->sortdirection = '';
        }
    }


    public function getReservationByDate()
    {
        $home = Reservation::whereBetween('date_created', [
            $this->start_date . " 00:00:00",
            $this->end_date . " 23:59:59"
        ])
            ->when($this->sortdirection != '', function ($q) {
                return $q->orderBy($this->sortby, $this->sortdirection);
            })
            ->paginate($this->displaypage);
        return $home;

        // return Reservation::get();
    }
}
