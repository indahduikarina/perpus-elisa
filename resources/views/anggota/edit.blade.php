@extends('layouts.app')

@section('content')
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">Edit Anggota</h2>

        <!-- Formulir untuk mengupdate data anggota, pastikan menggunakan route() dengan parameter yang benar -->
        <form action="{{ route('anggota.update', $anggota->idanggota) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Nama:</label>
                <input type="text" name="nama" value="{{ old('nama', $anggota->nama) }}" class="border rounded px-3 py-2 w-full" required>
                @error('nama')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block">Jenis Kelamin:</label>
                <select name="jeniskelamin" class="border rounded px-3 py-2 w-full" required>
                    <option value="Pria" {{ $anggota->jeniskelamin == 'Pria' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Wanita" {{ $anggota->jeniskelamin == 'Wanita' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jeniskelamin')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block">Alamat:</label>
                <input type="text" name="alamat" value="{{ old('alamat', $anggota->alamat) }}" class="border rounded px-3 py-2 w-full" required>
                @error('alamat')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block">Status:</label>
                <input type="text" name="status" value="{{ old('status', $anggota->status) }}" class="border rounded px-3 py-2 w-full" required>
                @error('status')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
@endsection
