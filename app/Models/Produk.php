<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori_id',
        'deskripsi',
        'gambar',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['nama_produk'] = $value;
        $this->attributes['kode_produk'] = Str::kode_produk($value);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
