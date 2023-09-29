<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'midname',
        'lastname',
        'contact_no',
        'img',
        'address',
        'age',
        'birthday',
        'driver_license',
        'plate_number',
        'franchise_no',
        'register_number',
        'or_cr',
        'username',
        'password',
        'toda_id',
    ];

}
