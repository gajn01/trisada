<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toda extends Model
{
    use HasFactory;
    protected $fillable = [
        'toda_name',
        'toda_address',
        'created_at',
        'updated_at'
    ];
}
