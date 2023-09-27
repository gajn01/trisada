<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    protected $fillable = [
        'name',
        'employee_id',
        'department_id',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'driver_id','id');
    }
    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    
}
