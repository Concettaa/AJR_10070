<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_driver',
        'email_driver',
        'nama_driver',
        'alamat_driver',
        'tanggal_lahir_driver',
        'jenis_kelamin_driver',
        'no_telp_driver',
        'bahasa'
    ];
}
