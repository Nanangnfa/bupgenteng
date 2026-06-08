<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pemesanan',
        'bibit_id',
        'nama_customer',
        'no_whatsapp',
        'alamat',
        'jumlah_pesan',
        'catatan',
        'status',
    ];

    public function bibit()
    {
        return $this->belongsTo(Bibit::class);
    }
}
