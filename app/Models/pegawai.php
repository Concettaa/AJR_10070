<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pegawai',
        'nama_pegawai',
        'alamat_pegawai',
        'tanggal_lahir_pegawai',
        'email_pegawai',
        'no_telp_pegawai',
        'jenis_kelamin_pegawai',
        'id_role'
    ];
}
