<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripCategory extends Model
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
        'description',
        'priority_level',
        'created_by_id',
        'last_updated_by_id',
    ];

    public function getPriorityLevelStringAttribute()
    {
        $label = array("Low", "Moderate", "High");

        return $label[$this->priority_level];
    }

    public function getPriorityLevelColorAttribute()
    {
        $text_color = array("text-warning", "text-success", "text-danger");

        return $text_color[$this->priority_level];
    }

}
