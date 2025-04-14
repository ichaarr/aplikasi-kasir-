<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'pelanggans';

    // Nama primary key jika tidak menggunakan 'id'
    protected $primaryKey = 'PelangganID';

    // Daftar field yang bisa diisi
    protected $fillable = [
        'NamaPelanggan',
        'Alamat',
        'NomerTelepon'
    ];
    
    // Relasi dengan tabel Penjualan (One to Many)
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'PelangganID', 'PelangganID');
    }
}
