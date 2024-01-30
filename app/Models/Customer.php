<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'nama_customer',
        'id_kendaraan',
        'tanggal_mulai_sewa',
        'tanggal_selesai_sewa',
        'harga_sewa',
        'id_kendaraan'
    ];

    use HasFactory;
}
