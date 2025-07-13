<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori_id',
        'harga_jual',
        'harga_beli',
        'stok'
    ];

    protected $primaryKey = 'kode_produk';
    protected $keyType = 'string';
    protected $table = 'produk';
    public $timestamps = false;
    public $incrementing = false;

    public function kategori()
{
    return $this->belongsTo(Kategori::class, 'kategori_id');
}
}
