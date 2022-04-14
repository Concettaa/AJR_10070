<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\carbon;

class customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_customer';
    protected $keyType = 'string';
    public $timestamps = false;

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
