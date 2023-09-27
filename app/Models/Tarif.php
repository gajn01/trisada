<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;
    protected $table = 'tarif';
    protected $fillable = [
        'description',
        'created_by_id',
        'last_updated_by_id',
    ];
}
