<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Daftarkan kolom agar bisa diisi (Mass Assignment)
    protected $fillable = ['name', 'slug', 'icon', 'color'];

    /**
     * Relasi One-to-Many ke model Book.
     * Satu kategori memiliki banyak buku.
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}