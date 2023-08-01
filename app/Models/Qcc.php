<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qcc extends Model
{
    use HasFactory;

    protected $table = 'qcc';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'tema',
        'kontes',
        'nama_qcc',
        'juara_sai',
        'juara_pasi',
    ];
}
