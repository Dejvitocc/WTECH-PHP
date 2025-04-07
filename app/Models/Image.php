<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable =[ ' text', 'route','productid'];

    public function product(){
        return $this->belongsTo(Product::class, 'productid','id');
    }
}
