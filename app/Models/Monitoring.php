<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Monitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'bibit_id',
        'tanggal_monitoring',
        'jumlah_mati',
        'stok_akhir',
        'catatan',
    ];

    public function bibit()
    {
        return $this->belongsTo(Bibit::class);
    }
}
