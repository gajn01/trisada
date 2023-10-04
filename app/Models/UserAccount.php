<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;
    protected $table ="tbl_user_accounts";
    protected $fillable = [
        'user_id',
        'user_type',
        'firstname',
        'lastname',
        'midname',
        'contact_no',
        'img',
        'age',
        'address',
        'birthday',
        'email',
        'username',
        'password',
    ];
}
