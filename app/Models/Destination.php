<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    protected $fillable = [
        'reservation_id',
        'destination',
        'order',
        'km'
    ];
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function last_updated_by()
    {
        return $this->belongsTo(User::class, 'last_updated_by_id', 'id');
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
