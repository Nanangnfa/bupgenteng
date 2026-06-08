<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bibit extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_bibit',
        'nama_ikan',
        'tanggal_tebar',
        'jumlah_awal',
        'stok_sekarang',
        'deskripsi',
        'status'
    ];

    public function monitorings()
    {
        return $this->hasMany(Monitoring::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}