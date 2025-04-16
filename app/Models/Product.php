<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'producerInfo',
        'price',
        'color',
        'size',
        'productInfo',
        'stockQuantity'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'productcategories', 'productid', 'categoryid')
                   ->withPivot('subcategoryid');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'productid', 'id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }
}
