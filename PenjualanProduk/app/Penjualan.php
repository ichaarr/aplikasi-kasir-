<?php

namespace App; // Pastikan namespace sesuai dengan struktur Laravel 8 atau lebih baru

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
   
    // Nama tabel yang digunakan (opsional jika nama tabel sesuai dengan plural form dari model)
    protected $table = 'penjualans';

    // Nama primary key jika tidak menggunakan 'id'
    protected $primaryKey = 'PenjualanID';

    // Daftar field yang bisa diisi (fillable)
    protected $fillable = [
        'TanggalPenjualan',
        'TotalHarga',
        'PelangganID'
        
    ];

    

    // Relasi dengan model Pelanggan (Penjualan belongsTo Pelanggan)
    // Model Penjualan
public function pembayaran()
{
    return $this->hasOne(Pembayaran::class, 'PenjualanID', 'PenjualanID');
}



    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'PenjualanID');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID');
    }
}
