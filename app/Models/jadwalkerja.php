<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwalkerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jadwal',
        'nama_pegawai',
        'hari',
        'jam_kerja'
    ];
}
