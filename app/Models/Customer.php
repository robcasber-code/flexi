<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'country',
        'city',
        'phone',
    ];
}
