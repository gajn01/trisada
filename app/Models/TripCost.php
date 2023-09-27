<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripCost extends Model
{
    use HasFactory;
    protected $table = 'trip_cost';
    protected $fillable = [
        'trip_ticket_id',
        'tarif_description',
        'release_amount',
        'unrelease_amount',
        'created_by_id',
        'last_updated_by_id',
    ];
}
