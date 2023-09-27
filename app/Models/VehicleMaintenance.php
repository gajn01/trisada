<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMaintenance extends Model
{
    use HasFactory;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    protected $fillable = [
        'vehicle_id',
        'start_date',
        'end_date',
        'remarks',
        'created_by_id',
        'last_updated_by_id',
    ];
    protected $cast = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];
    public function getStatusLabelAttribute()
    {
        $status_label = array("Open", "Closed");
        return $status_label[$this->end_date ? 1 : 0];
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }
    public function last_updated_by()
    {
        return $this->belongsTo(User::class, 'last_updated_by_id');
    }
}
