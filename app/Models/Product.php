<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'views', // 🔥 WAJIB
    ];

    /**
     * Cast data type
     */
    protected $casts = [
        'price' => 'integer',
        'views' => 'integer',
    ];

    /**
     * Relasi ke Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
