<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'nama_lengkap', 'email', 'nomor_handphone', 
        'alamat_lengkap', 'kota', 'kode_pos', 'kode_produk'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}