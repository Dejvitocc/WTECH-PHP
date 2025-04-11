<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOption extends Model
{
    protected $table = 'delivery_options';

    protected $fillable = [
        'name',
        'price',
        'icon_route',
    ];
}
