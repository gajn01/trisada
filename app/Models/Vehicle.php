<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'make',
        'model',
        'passenger_capacity',
        'fuel_type',
        'fuel_capacity',
        'plate_number',
        'coding_day',
        'mv_file_number',
        'cr_number',
        'chassis_number',
        'engine_number',
        'color',
        'registration_date',
        'status',
        'vehicle_type_id',
        'created_by_id',
        'last_updated_by_id',
    ];
    protected $cast = [
        'registration_date' => 'date:Y-m-d',
    ];

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'vehicle_id', 'id');
    }

    public function vehicle_maintenances()
    {
        return $this->hasMany(VehicleMaintenance::class, 'vehicle_id','id');
    }
    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'vehicle_id','id');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function getVehicleNameAttribute()
    {
        return $this->make . ' ' . $this->model;
    }

    public function getCodingDayStringAttribute()
    {
        $day = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "NA");
        return $day[$this->coding_day];
    }

    public function lto_vehicle_registrations()
    {
        return $this->hasMany(LtoVehicleRegistration::class, 'vehicle_id', 'id');
    }

    public function getStatusStringAttribute()
    {
        $status_label = array("Unavailable", "Available", "Retired Fleet");

        return $status_label[$this->status];
    }

}
