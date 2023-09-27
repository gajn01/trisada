<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripTicket extends Model
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
        'reservation_id',
        'transaction_type',
        'ticket_date',
        'status',
        'release_date',
        'return_date',
        'closed_date',
        'initial_fuel_bar',
        'final_fuel_bar',
        'initial_odometer_reading',
        'final_odometer_reading',
        'released_by_id',
        'received_by',
        'created_by_id',
        'closed_by_id',
    ];

    protected $cast = [
        'release_date' => 'date:Y-m-d H:i:s',
        'return_date' => 'date:Y-m-d H:i:s',
        'closed_date' => 'date:Y-m-d H:i:s',
    ];
    public function getStatusStringAttribute()
    {
        $status_label = array("For Release", "Released", "Finalized","Cancelled");
        return $status_label[$this->status];
    }
    public function getStatusBadgeAttribute()
    {
        $status_badge = array("bg-warning", "bg-primary", "bg-success","bg-danger");
        return $status_badge[$this->status];
    }
    public function getTransactionsAttribute()
    {
        $transaction_label = array("Pull-out", "Regular Deliveries", "H.O. Company Vehicles", "Others");
        return $transaction_label[$this->transaction_type];
    }
    public function getFuelBarLabelAttribute(){
        $fuel_bar_label = array("Empty", "Low", "Half", "Almost Full", "Full");
        return $fuel_bar_label[$this->initial_fuel_bar ?? 0];
    }
    public function getFinalFuelBarLabelAttribute(){
        $final_fuel_bar_label = array("Empty", "Low", "Half", "Almost Full", "Full");
        return $final_fuel_bar_label[$this->final_fuel_bar ?? 0];
    }
    public function reservation()
    {
        return $this->BelongsTo(Reservation::class, 'reservation_id', 'id');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function released_by()
    {
        return $this->belongsTo(User::class, 'released_by_id', 'id');
    }

    public function closed_by()
    {
        return $this->belongsTo(User::class, 'closed_by_id', 'id');
    }
}