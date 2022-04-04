<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'plat_mobil',
        'nama_mobil',
        'tipe_mobil',
        'jenis_transaksi',
        'jenis_bahan_bakar',
        'volume_bahan_bakar',
        'warna_mobil',
        'kapasitas_penumpang',
        'fasilitas',
        'nomor_stnk',
        'no_ktp_pemilik',
        'id_brosur'
    ];
}
