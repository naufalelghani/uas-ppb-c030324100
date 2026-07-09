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
    <a href="{{ route('pesan') }}" class="flex-1 py-3 text-center text-sm font-bold border-b-2 border-blue-600 text-blue-600 bg-white">
        Pesan Produk
    </a>
    <a href="{{ route('riwayat') }}" class="flex-1 py-3 text-center text-sm font-bold text-gray-500 hover:text-blue-500">
        Riwayat
    </a>
</div>

<!-- Form Pesan Produk -->
<div class="flex-grow flex flex-col overflow-hidden">
    <div class="h-6 bg-red-custom w-full shrink-0"></div>
    
    <div class="p-5 overflow-y-auto no-scrollbar flex-grow bg-white">
        <h2 class="text-[22px] text-gray-700 mb-2">Pesan Produk</h2>
        <hr class="border-gray-300 mb-5">

        @if(session('success'))
            <div class="alert-box bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded mb-4 text-xs font-bold">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pesan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="flex items-center">
                <label class="w-[130px] text-[13px] text-gray-700 shrink-0">Nama Lengkap*</label>
                <span class="mr-2 text-gray-600">:</span>
                <input type="text" name="nama_lengkap" required class="flex-grow h-8 px-2 input-bordered text-[13px] rounded-sm">
            </div>
            <div class="flex items-center">
                <label class="w-[130px] text-[13px] text-gray-700 shrink-0">Email *</label>
                <span class="mr-2 text-gray-600">:</span>
                <input type="email" name="email" required class="flex-grow h-8 px-2 input-bordered text-[13px] rounded-sm">
            </div>
            <div class="flex items-center">
                <label class="w-[130px] text-[13px] text-gray-700 shrink-0">Nomor Handphone*</label>
                <span class="mr-2 text-gray-600">:</span>
                <input type="text" name="nomor_handphone" required class="flex-grow h-8 px-2 input-bordered text-[13px] rounded-sm">
            </div>
            <div class="flex items-center">
                <label class="w-[130px] text-[13px] text-gray-700 shrink-0">Alamat Lengkap *</label>
                <span class="mr-2 text-gray-600">:</span>
                <input type="text" name="alamat_lengkap" required class="flex-grow h-8 px-2 input-bordered text-[13px] rounded-sm">
            </div>

            <!-- Baris Kota & Kode Pos -->
            <div class="flex items-center">
                <div class="w-[130px] shrink-0"></div>
                <span class="mr-2 text-transparent">:</span>
                <div class="flex-grow flex items-center justify-between">
                    <span class="text-[13px] text-gray-700 mr-1 whitespace-nowrap">Kota *</span>
                    <input type="text" name="kota" required class="w-full h-8 px-2 input-bordered text-[13px] rounded-sm mr-2">
                    <span class="text-[13px] text-gray-700 mr-1 whitespace-nowrap">Kode Pos *</span>
                    <input type="text" name="kode_pos" required class="w-[60px] h-8 px-2 input-bordered text-[13px] rounded-sm">
                </div>
            </div>

            <!-- Dropdown Pilihan Produk -->
            <div class="flex items-center pb-4">
                <label class="w-[130px] text-[13px] text-gray-700 shrink-0">Kode Produk*</label>
                <span class="mr-2 text-gray-600">:</span>
                <select name="kode_produk" class="h-8 px-2 input-bordered text-[13px] rounded-sm bg-white w-[100px]">
                    <option value="DC 001">DC 001</option>
                    <option value="DC 002">DC 002</option>
                    <option value="DC 003">DC 003</option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center pt-2">
                <div class="w-[130px] shrink-0"></div>
                <span class="mr-2 text-transparent">:</span>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-[#e5e7eb] text-black text-[13px] px-4 py-1.5 rounded-sm hover:bg-gray-300 shadow-sm border border-gray-300 font-medium">
                        Pesan sekarang
                    </button>
                    <button type="reset" class="bg-[#e5e7eb] text-black text-[13px] px-4 py-1.5 rounded-sm hover:bg-gray-300 shadow-sm border border-gray-300 font-medium">
                        Batal Pesan
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="bg-blue-custom w-full p-4 shrink-0">
        <p class="text-white text-lg font-medium">Cara Pemesanan</p>
    </div>
</div>
@endsection