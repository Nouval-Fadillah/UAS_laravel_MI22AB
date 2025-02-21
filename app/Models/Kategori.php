<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori', 'slug', 'is_active',
    ];

    public function produks() 
    {
        return $this->hasMany(Produk::class);
    }

    // public function setNameAttribute($value)
    // {
    //     $this->attributes['nama_kategori'] = $value;
    // }
}
