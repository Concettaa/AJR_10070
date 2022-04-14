<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';
    protected $keyType = 'string';
    public $timestamps = false;

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

    public function pegawai()
    {
        return $this->belongsTo(pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function customer()
    {
        return $this->belongsTo(customer::class, 'id_customer', 'id_customer');
    }

    public function driver()
    {
        return $this->belongsTo(driver::class, 'id_driver', 'id_driver');
    }

    public function promo()
    {
        return $this->belongsTo(promo::class, 'kode_promo', 'kode_promo');
    }

    public function mobil()
    {
        return $this->belongsTo(mobil::class, 'plat_mobil', 'plat_mobil');
    }
}
