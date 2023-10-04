<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table ="tbl_user_accounts";
    protected $fillable = [
        'firstname',
        'midname',
        'lastname',
        'contact_no',
        'img',
        'address',
        'email',
        'age',
        'birthday',
        'username',
        'password',
    ];
}
