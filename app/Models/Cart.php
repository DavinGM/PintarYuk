<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'voucher_id'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function getSubtotalAttribute()
    {
        // Assuming items have 'book' relationship loaded and 'price' attribute
        return $this->items->sum(function ($item) {
            return $item->book ? $item->book->price * $item->qty : 0;
        });
    }

    public function getDiscountAmountAttribute()
    {
        if (!$this->voucher)
            return 0;

        $subtotal = $this->subtotal;

        if ($subtotal < $this->voucher->min_spend)
            return 0;

        if ($this->voucher->type === 'percentage') {
            return $subtotal * ($this->voucher->reward_amount / 100);
        }

        return min($this->voucher->reward_amount, $subtotal);
    }

    public function getTotalAttribute()
    {
        return max(0, $this->subtotal - $this->discount_amount);
    }

    // Helper to get total count
    public function getCountAttribute()
    {
        return $this->items->sum('qty');
    }
}
