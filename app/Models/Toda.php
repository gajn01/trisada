<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toda extends Model
{
    use HasFactory;
    // protected $table ='tbl_toda';

    protected $fillable = [
        'toda_name',
        'toda_desc',
        'toda_brgy',
        'created_at',
        'updated_at'
    ];
}
