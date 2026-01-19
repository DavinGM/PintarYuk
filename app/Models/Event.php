<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'image', 'voucher_id', 'is_active'];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
