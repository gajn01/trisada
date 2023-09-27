<?php
namespace App\Http\Livewire\Dashboard;
use Livewire\Component;
use App\Helpers\AvailabilityHelper;
use App\Models\Reservation;
use App\Models\Destination;
class DailyUpdatesCard extends Component
{
    public $destination_list;
    public function render()
    {
        $reservations = Reservation::whereDate('pickup_date',date('Y-m-d'))->where('status',2)->get();
        foreach ($reservations as $key => $value) {
            if($value->destination == 0){
                $value->destination_list = Destination::where('reservation_id',$value->id)->get();
            }
        }
        $vehicles = AvailabilityHelper::getAvailableVehicles(date('Y-m-d '.'00:00:00'),date('Y-m-d '.'23:59:59'));
        return view('livewire.dashboard.daily-updates-card',['vehicles'=>$vehicles, 'reservations' => $reservations]);
    }
}
