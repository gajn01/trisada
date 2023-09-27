<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
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
        'code',
        'name',
        'description',
        'created_by_id',
        'last_updated_by_id',
    ];


    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id','id');
    }

    public function last_updated_by()
    {
        return $this->belongsTo(User::class, 'last_updated_by_id','id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
