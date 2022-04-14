<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailjadwal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_detail',
        'id_pegawai',
        'id_jadwal'
    ];

    public function jadwalkerja()
    {
        return $this->belongsTo(jadwalkerja::class, 'id_jadwal', 'id_jadwal');
    }

    public function pegawai()
    {
        return $this->belongsTo(pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
