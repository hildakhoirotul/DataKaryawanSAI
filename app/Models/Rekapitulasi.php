<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekapitulasi extends Model
{
    use HasFactory;

    protected $table = 'rekapitulasi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'SD',
        'S',
        'I',
        'A',
        'ITD',
        'ICP',
        'TD',
        // 'CP',
        'OCHI',
        'QCC',
        'OCHI_leader',
        'Juara_OCHI',
        'Juara_QCC',
    ];
}
