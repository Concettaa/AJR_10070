<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobil extends Model
{
    use HasFactory;

    protected $primaryKey = 'plat_mobil';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'plat_mobil',
        'nama_mobil',
        'tipe_mobil',
        'jenis_transmisi',
        'jenis_bahan_bakar',
        'volume_bahan_bakar',
        'warna_mobil',
        'kapasitas_penumpang',
        'fasilitas',
        'nomor_stnk',
        'no_ktp_pemilik',
        'id_brosur'
    ];

    public function mobilmitra()
    {
        return $this->belongsTo(mobilmitra::class, 'no_ktp_pemilik', 'no_ktp_pemilik');
    }

    public function brosur()
    {
        return $this->belongsTo(brosur::class, 'id_brosur', 'id_brosur');
    }
}
