@extends('layouts.app')

@section('content')
    <div class="p-4 max-w-2xl mx-auto">
        <h2 class="text-3xl font-bold text-pink-700 mb-6">➕ Tambah Anggota</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-pink-100 border border-pink-300 rounded text-pink-800">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('anggota.store') }}" method="POST" class="bg-pink-50 p-6 rounded-lg shadow-md border border-pink-200 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">ID Anggota</label>
                <input type="text" name="idanggota"
                       class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Nama</label>
                <input type="text" name="nama"
                       class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Jenis Kelamin</label>
                <select name="jeniskelamin"
                        class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400"
                        required>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Alamat</label>
                <textarea name="alamat"
                          class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400"
                          required></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Status</label>
                <input type="text" name="status"
                       class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400"
                       required>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('anggota.index') }}"
                   class="text-pink-600 hover:underline">← Kembali ke Daftar</a>
                <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
