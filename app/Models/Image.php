<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable =[ 'text', 'route','productid'];
    public $timestamps = false; 

    public function product(){
        return $this->belongsTo(Product::class, 'productid','id');
    }
}
