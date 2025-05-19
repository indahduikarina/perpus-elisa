@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Tambah Buku</h2>
    <form action="{{ route('buku.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label>ID Buku:</label>
            <input type="text" name="idbuku" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label>Judul:</label>
            <input type="text" name="judulbuku" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label>Kategori:</label>
            <input type="text" name="kategori" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label>Pengarang:</label>
            <input type="text" name="pengarang" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label>Penerbit:</label>
            <input type="text" name="penerbit" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label>Status:</label>
            <input type="text" name="status" class="border rounded px-3 py-2 w-full">
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
