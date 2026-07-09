@extends('layouts.app') <!-- Sesuaikan dengan nama layout utama kamu -->
@section('title', 'Login Admin')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Card Container -->
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-[2rem] shadow-xl border border-slate-100">
        
        <!-- Header & Logo -->
        <div class="text-center">
            <img class="mx-auto h-24 w-auto drop-shadow-sm" src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa">
            <h2 class="mt-6 text-3xl font-extrabold text-slate-900 tracking-tight">LOGIN ADMIN</h2>
            <p class="mt-2 text-sm text-slate-500 font-medium">Sistem Informasi Pemerintahan Desa Parengan</p>
        </div>

        <!-- Form Login -->
        <form class="mt-8 space-y-6" action="#" method="POST">
            @csrf
            <div class="space-y-5">
                
                <!-- Input Email -->
                <div>
                    <label for="username" class="block text-sm font-bold text-slate-700 mb-1">Nama Admin</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-slate-400"></i>
                        </div>
                        <input id="username" name="username" type="text" required 
                            class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all" 
                            placeholder="Masukkan nama admin">
                    </div>
                </div>

                <!-- Input Password (dengan fitur Show/Hide Alpine.js) -->
                <div x-data="{ show: false }">
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-1">Password</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-slate-400"></i>
                        </div>
                        <input id="password" name="password" :type="show ? 'text' : 'password'" required 
                            class="block w-full pl-11 pr-11 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all" 
                            placeholder="Masukkan password">
                        
                        <!-- Toggle Password Visibility -->
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer" @click="show = !show">
                            <i class="fa-solid text-slate-400 hover:text-blue-500 transition-colors" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4 pt-2">
                <button type="submit" 
                    class="w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    <i class="fa-solid fa-right-to-bracket"></i> MASUK ADMIN
                </button>
                
                <a href="{{ route('desa.home') }}" 
                    class="w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-slate-200 rounded-xl text-sm font-bold text-slate-600 bg-white hover:bg-slate-50 focus:outline-none transition-all">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </form>
    </div>
</div>
@endsection