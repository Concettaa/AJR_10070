<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brosur extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_brosur';
    public $timestamps = false;
    
    protected $fillable = [
        'id_brosur', 
        'nama_mobil', 
        'tipe_mobil',
        'jenis_transmisi', 
        'jenis_bahan_bakar', 
        'warna_mobil',
        'volume_bagasi',
        'fasilitas',
        'harga_sewa'
    ];
}
