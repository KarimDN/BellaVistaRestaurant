<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email', 
        'customer_phone',
        'reservation_date',
        'reservation_time',
        'guests',
        'special_requests',
        'status'
    ];
}