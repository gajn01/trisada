<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    // protected $table ='tbl_driver_details';
    protected $fillable = [
        'user_id',
        'driver_license',
        'plate_number',
        'franchise_no',
        'register_number',
        'or_cr',
        'toda_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function toda()
    {
        return $this->belongsTo(Toda::class,'toda_id','id');
    }


}
