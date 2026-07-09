<!-- Naufal Elghani C030324100 -->
@extends('layouts.app')

@section('content')
<!-- App Bar -->
<div class="bg-white px-4 py-3 flex justify-between items-center shadow-sm border-b">
    <span class="font-bold text-gray-700 text-sm">Aplikasi C030324100</span>
    <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="text-red-500 text-sm font-semibold flex items-center hover:text-red-700">
            Logout
        </button>
    </form>
</div>

<!-- Tab Navigation -->
<div class="flex border-b bg-gray-50">
    <a href="{{ route('pesan') }}" class="flex-1 py-3 text-center text-sm font-bold text-gray-500 hover:text-blue-500">
        Pesan Produk
    </a>
    <a href="{{ route('riwayat') }}" class="flex-1 py-3 text-center text-sm font-bold border-b-2 border-blue-600 text-blue-600 bg-white">
        Riwayat
    </a>
</div>

<!-- Daftar Riwayat -->
<div class="flex-grow p-4 bg-gray-100 overflow-y-auto no-scrollbar">
    <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Riwayat Transaksi</h2>
    
    @if($orders->isEmpty())
        <div class="text-center py-10">
            <p class="text-sm text-gray-500">Belum ada pesanan.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($orders as $order)
                <div class="bg-white p-3 rounded shadow-sm border border-gray-200">
                    <div class="flex justify-between items-start mb-2">
                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">
                            {{ $order->kode_produk }}
                        </span>
                        <span class="text-xs text-gray-500 font-medium">
                            {{ $order->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 mb-1">{{ $order->nama_lengkap }}</p>
                    <p class="text-xs text-gray-600 line-clamp-1">{{ $order->alamat_lengkap }}, {{ $order->kota }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection