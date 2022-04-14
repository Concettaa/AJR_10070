<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_role';
    public $timestamps = false;

    protected $fillable = [
        'id_role',
        'nama_role',
    ];
}
