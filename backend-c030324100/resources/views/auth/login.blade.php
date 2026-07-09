<!-- Naufal Elghani C030324100 -->
@extends('layouts.app')

@section('content')
<div class="flex-grow flex flex-col p-8 justify-center bg-white z-50">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800">Login</h1>
        <p class="text-sm text-gray-500 mt-2">Naufal Elghani C030324100</p>
        <p class="text-xs text-gray-400">UAS-PPB_TI_4C_C030324100</p>
    </div>
    
    @if(session('success'))
        <div class="alert-box bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-box bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <input type="email" name="email" required class="w-full p-3 input-bordered rounded-md text-sm" value="{{ old('email') }}">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
            <input type="password" name="password" required class="w-full p-3 input-bordered rounded-md text-sm">
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-md hover:bg-blue-700 transition duration-200 mt-4">
            Masuk
        </button>
    </form>
</div>
@endsection