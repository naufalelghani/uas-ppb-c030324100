<?php
// Naufal Elghani C030324100
// File: app/Http/Controllers/Api/OrderController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // GET: Riwayat pesanan user yang login
    public function index(Request $request)
    {
        // $request->user() secara otomatis mendapatkan data user dari token yang dikirim
        $orders = Order::where('user_id', $request->user()->id)
                       ->latest()
                       ->get();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat pesanan berhasil diambil',
            'data'    => $orders
        ], 200);
    }

    // POST: Simpan pesanan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'nomor_handphone' => 'required|string|max:20',
            'alamat_lengkap'  => 'required|string',
            'kota'            => 'required|string|max:100',
            'kode_pos'        => 'required|string|max:10',
            'kode_produk'     => 'required|string|max:50',
        ]);

        // Simpan data dengan menyisipkan user_id dari token
        $order = Order::create([
            'user_id'         => $request->user()->id,
            'nama_lengkap'    => $validated['nama_lengkap'],
            'email'           => $validated['email'],
            'nomor_handphone' => $validated['nomor_handphone'],
            'alamat_lengkap'  => $validated['alamat_lengkap'],
            'kota'            => $validated['kota'],
            'kode_pos'        => $validated['kode_pos'],
            'kode_produk'     => $validated['kode_produk'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil disimpan',
            'data'    => $order
        ], 201);
    }
}