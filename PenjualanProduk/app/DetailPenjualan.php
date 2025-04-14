<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detailpenjualans';
    protected $primaryKey = 'DetailID';
    protected $fillable = [
        'PenjualanID',
        'ProdukID',
        'JumlahProduk',
        'SubTotal',
    ];

    public function produk()
{
    return $this->belongsTo(Produk::class, 'ProdukID');
}

public function penjualan()
{
    return $this->belongsTo(Penjualan::class, 'PenjualanID');
}
    protected static function boot()
    {
        parent::boot();

        // Saat detail penjualan dibuat, cek stok terlebih dahulu
        static::creating(function ($detailPenjualan) {
            $produk = $detailPenjualan->produk;
            if ($produk) {
                if ($produk->Stok < $detailPenjualan->JumlahProduk) {
                    throw new \Exception("Stok tidak mencukupi untuk produk: {$produk->NamaProduk}");
                }
            }
        });

        static::created(function ($detailPenjualan) {
            $produk = $detailPenjualan->produk;
            if ($produk) {
                // Pastikan stok tidak negatif
                if ($produk->Stok >= $detailPenjualan->JumlahProduk) {
                    $produk->decrement('Stok', $detailPenjualan->JumlahProduk);
                }
            }
        });

        static::deleted(function ($detailPenjualan) {
            $produk = $detailPenjualan->produk;
            if ($produk) {
                $produk->increment('Stok', $detailPenjualan->JumlahProduk);
            }
        });
    }
}
