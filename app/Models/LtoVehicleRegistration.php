<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LtoVehicleRegistration extends Model
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
        'or_number',
        'or_date',
        'validity_date',
        'renewal_start_date',
        'renewal_end_date',
        'vehicle_id',
        'created_by_id',
        'last_updated_by_id',
    ];

    protected $cast = [
        'or_date' => 'date:Y-m-d',
        'validity_date' => 'date:Y-m-d',
        'renewal_start_date' => 'date:Y-m-d',
        'renewal_end_date' => 'date:Y-m-d',
    ];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }
}
