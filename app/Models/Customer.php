<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email',
        'name',
        'surname',
        'password',
        'privacy_consent',
        'phone_number',
        'street',
        'home_number',
        'postal_code',
        'city',
        'country',
    ];

    public $timestamps = true;
}
