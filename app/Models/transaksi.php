<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'id_pegawai',
        'id_customer',
        'id_driver',
        'tanggal_transaksi',
        'mulai_sewa',
        'akhir_sewa',
        'tanggal_kembali',
        'kode_promo',
        'plat_mobil',
        'harga_sewa_perhari',
        'metode_pembayaran',
        'jumlah',
        'sub_jumlah',
        'tarif_driver_perhari',
        'status_verifikasi',
        'status_lunas',
        'rating',
        'status_driver'
    ];
}
