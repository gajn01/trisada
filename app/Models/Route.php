<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'area',
        'concatenante',
        'scheme',
        'route_code',
        'stores',
        'km_travelled',
        'liters',
        'fuel',
        'p_o',
        'fuel_cash_request',
        'salary',
        'food_allowance',
        'parking',
        'easytrip',
        'autosweep',
        'toll_fee',
        'created_by_id',
        'last_updated_by_id',
    ];
}
