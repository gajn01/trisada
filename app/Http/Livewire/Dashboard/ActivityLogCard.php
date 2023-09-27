<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\ActivityLog;

class ActivityLogCard extends Component
{

    public function render()
    {
        $logs = ActivityLog::orderBy('date_created', 'desc')
        ->limit(30)
        ->get();
        return view('livewire.dashboard.activity-log-card', ["logs"=>$logs]);
    }
}
