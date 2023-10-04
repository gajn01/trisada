<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    use HasFactory;
    // protected $table = 'tbl_terminal';
    protected $fillable = [
        'toda_id',
        'terminal_name',
        'terminal_address',
        'terminal_long',
        'terminal_lat',
        'created_at',
        'updated_at'
    ];
    public function toda()
    {
        return $this->belongsTo(Toda::class,'toda_id','id');
    }
}
