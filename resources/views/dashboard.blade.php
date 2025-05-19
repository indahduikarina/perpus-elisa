@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">
            Dashboard Admin Perpustakaan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Container for dashboard content -->
            <div class="bg-[var(--pink-soft)] p-6 rounded-lg shadow-lg">
                <!-- Greeting Message -->
                <h3 class="text-2xl font-bold text-[var(--pink-dark)] mb-4">
                    Hai, {{ Auth::user()->name }}! 👋
                </h3>
                <p class="text-[var(--pink-dark)]">
                    Selamat datang di Sistem Informasi Perpustakaan Laravel.
                </p>
                <p class="mt-3 text-white-600">
                    Silakan pilih menu di atas untuk mengelola anggota, buku, atau peminjaman.
                </p>
            </div>
        </div>
    </div>
@endsection
