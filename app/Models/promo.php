<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promo extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_promo';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode_promo',
        'jenis_promo',
        'keterangan',
        'nilai_promo'
    ];
}
