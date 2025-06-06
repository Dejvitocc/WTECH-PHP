<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'productcategories', 'categoryid', 'productid')
                   ->withPivot('subcategoryid');
    }
}
