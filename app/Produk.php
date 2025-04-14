<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks'; // Nama tabel di database
    protected $primaryKey = 'ProdukID'; // Primary key
    public $incrementing = true;
    public $timestamps = true; // Tambahkan ini jika tabel punya timestamps (created_at & updated_at)

    protected $fillable = [
        'KategoriID', 'NamaProduk', 'Harga', 'Stok',
    ];

    public function kurangiStok($jumlah)
    {
        if ($this->Stok < $jumlah) {
            return false; // Tidak cukup stok
        }
        $this->decrement('Stok', $jumlah);
        return true;
    }

    public function tambahStok($jumlah)
    {
        $this->increment('Stok', $jumlah);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'KategoriID');
    }

    public function detailPenjualan()
{
    return $this->hasMany(DetailPenjualan::class, 'ProdukID');
}
}