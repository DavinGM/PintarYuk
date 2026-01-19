<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bookmark;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $appends = ['final_price'];
    protected $fillable = [
        'category_id', 'title', 'author', 'price', 
        'discount_percentage', 'is_on_sale', 'stock', 
        'description', 'cover', 'sold_count'
    ];


    public function getFinalPriceAttribute()
    {
        if ($this->is_on_sale && $this->discount_percentage > 0) {
            return $this->price - ($this->price * ($this->discount_percentage / 100));
        }
        return $this->price;
    }

    /**
     * Relasi Many-to-One ke model Category.
     * Banyak buku dimiliki oleh satu kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

        public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

}