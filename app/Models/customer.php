<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'nama_customer',
        'alamat_customer',
        'tanggal_lahir_customer',
        'jenis_kelamin_customer',
        'email_customer',
        'no_telp_customer',
        'nomor_ktp'
    ];
}
