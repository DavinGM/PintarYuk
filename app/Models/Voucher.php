<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'title',
        'type',
        'reward_amount',
        'min_spend',
        'limit_usage',
        'expiry_date',
        'duration',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_vouchers')
            ->withPivot('is_used', 'claimed_at', 'expires_at')
            ->withTimestamps();
    }
}
