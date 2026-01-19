<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Helper to get total count
    public function getCountAttribute()
    {
        return $this->items->sum('qty');
    }
}
