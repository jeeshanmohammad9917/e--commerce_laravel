<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reg_User extends Model
{
    use HasFactory;
    protected $connection='mysql';
    protected $table='users';
    protected $fillable=[
        'id',
        'role_id',
        'fname',
        'lname',
        'email',
        'password',
        'contact',
        'gender',
        'address',
        'country',
        'profile'
    ];
}
