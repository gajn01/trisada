<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    protected $fillable = [
        'text',
        'created_by_id'
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id','id');
    }
}
