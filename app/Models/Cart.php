<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Calculate total
    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            if ($item->product) {
                $total += $item->product->price * $item->qty;
            }
        }
        return $total;
    }
}


