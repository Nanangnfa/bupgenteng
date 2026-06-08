<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilBalai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_balai',
        'sejarah',
        'visi',
        'misi',
        'alamat',
        'telepon',
        'email',
        'maps',
    ];
}
