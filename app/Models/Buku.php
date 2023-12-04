<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = ['id', 'judul', 'penulis', 'harga', 'tgl_terbit', 'created_at', 'updated_at', 'filename', 'filepath'];

    protected $dates = ['tgl_terbit'];

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function rating()
    {
        return $this->hasMany(Rate::class);
    }

    public function averageRate()
    {
        return $this->rating->avg('rating');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorite', 'buku_id', 'user_id');
    }
}