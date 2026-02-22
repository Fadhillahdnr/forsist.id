<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'qty'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Calculate subtotal
    public function getSubtotal()
    {
        if ($this->product) {
            return $this->product->price * $this->qty;
        }
        return 0;
    }
}


