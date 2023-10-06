<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'midname',
        'lastname',
        'contact_no',
        'address',
        'email',
        'age',
        'password',
    ];
}
