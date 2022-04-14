<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobilmitra extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_ktp_pemilik';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
      'nama_pemilik',
      'no_ktp_pemilik',
      'alamat_pemilik',
      'no_telp_pemilik',
      'periode_kontrak_mulai',
      'periode_kontrak_akhir',
      'tanggal_terakhir_kali_servis'
    ];
}
