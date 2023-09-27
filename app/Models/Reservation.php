<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';
    protected $fillable = [
        'own_driver',
        'trip_distance',
        'department_id',
        'head_count',
        'driver',
        'purpose',
        'pickup_date',
        'return_date',
        'pickup_location',
        'destination',
        'cancel_reason',
        'special_instruction',
        'status',
        'remarks',
        'created_by_id',
        'last_updated_by_id',
    ];
    protected $cast = [
        'pickup_date' => 'date:Y-m-d H:i:s',
        'return_date' => 'date:Y-m-d H:i:s',
    ];
    public function getStatusStringAttribute()
    {
        $status_label = array("Pre-Reserve","Pending", "Booked", "Declined", "Cancelled", "Approved");
        return $status_label[$this->status];
    }
    public function getStatusBadgeAttribute()
    {
        $status_badge = array("bg-secondary","bg-warning", "bg-success", "bg-danger", "bg-danger", "bg-info");
        return $status_badge[$this->status];
    }
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }
    public function last_updated_by()
    {
        return $this->belongsTo(User::class, 'last_updated_by_id', 'id');
    }
    public function cancelled_by()
    {
        return $this->belongsTo(User::class, 'cancelled_by_id', 'id');
    }
    public function declined_by()
    {
        return $this->belongsTo(User::class, 'declined_by_id', 'id');
    }
    public function company_driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
    public function own_driver_name()
    {
        return $this->belongsTo(Driver::class, 'driver', 'id');
    }
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
    public function booking_approval_by()
    {
        return $this->belongsTo(User::class, 'booking_approval_by_id', 'id');
    }
    public function ticket_created_by()
    {
        return $this->belongsTo(User::class, 'ticket_created_by_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id');
    }
    public function trip_ticket()
    {
        return $this->hasOne(TripTicket::class, 'reservation_id', 'id');
    }
    public function trip_category()
    {
        return $this->belongsTo(TripCategory::class, 'trip_category_id', 'id');
    }
    public function getCancelReasonDescriptionAttribute()
    {
        $reason = array(
            "Change of trip schedule.",
            "Trip cancelled.",
            "Others",
        );
        return $reason[$this->cancel_reason];
    }
    public function getDeclineReasonDescriptionAttribute()
    {
        $reason = array(
            "No vehicle available.",
            "No driver available.",
            "Others",
        );
        return $reason[$this->decline_reason];
    }
}