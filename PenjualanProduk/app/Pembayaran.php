<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{

    protected $table = 'pembayarans';

    
    // Tentukan kolom-kolom yang bisa diisi (fillable)
    protected $fillable = [
        'PenjualanID',
        'MetodePembayaran',
        'JumlahDibayarkan',
        'Kembalian',
    ];

    // Tentukan relasi dengan model Penjualan
    public function penjualan()
{
    return $this->belongsTo(Penjualan::class, 'PenjualanID');
}

}
