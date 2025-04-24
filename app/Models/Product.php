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
        'producerinfo',
        'price',
        'color',
        'size',
        'productinfo',
        'stockquantity'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'productcategories', 'productid', 'categoryid')
                   ->withPivot('subcategoryid');
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'productcategories', 'productid', 'subcategoryid')
                    ->withPivot('categoryid');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'productid', 'id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors')->withTimestamps();;
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes')->withTimestamps();;
    }
}
