<?php
// Naufal Elghani C030324100
// Proyek: UAS-PPB_TI_3C_C030324100

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class WebController extends Controller
{
    // --- AUTHENTICATION ---
    public function showLogin()
    {
        if (Auth::check()) return redirect()->route('pesan');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('pesan')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

    // --- PESAN PRODUK ---
    public function showPesan()
    {
        return view('pesan');
    }

    public function storePesan(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'nomor_handphone' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'kota' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'kode_produk' => 'required|string|max:50',
        ]);

        // Tambahkan user_id dari user yang sedang login
        $validated['user_id'] = Auth::id();

        Order::create($validated);

        return redirect()->route('pesan')->with('success', 'Pesanan berhasil dibuat!');
    }

    // --- RIWAYAT PESANAN ---
    public function showRiwayat()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('riwayat', compact('orders'));
    }
}