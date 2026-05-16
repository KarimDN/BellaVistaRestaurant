<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'category_id',
        'name', 
        'description', 
        'price', 
        'image', 
        'is_available'
    ];

    // Every menu item belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}