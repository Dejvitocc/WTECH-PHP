<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_cart';

    public $timestamps = false;

    
    protected $fillable = ['customer_id', 'product_id', 'quantity', 'color', 'size'];

    // Vzťah s modelom Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Vzťah s modelom Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
