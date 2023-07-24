<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ochi extends Model
{
    use HasFactory;
    protected $table = 'ochi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'tema',
        'nik_ochi_leader',
        'juara',
    ];
}
