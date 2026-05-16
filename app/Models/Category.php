<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'order'];

    // One category has many menu items
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}