@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Edit Buku</h2>
    <form action="{{ route('buku.update', $buku->idbuku) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label>Judul:</label>
            <input type="text" name="judulbuku" value="{{ $buku->judulbuku }}" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label>Kategori:</label>
            <input type="text" name="kategori" value="{{ $buku->kategori }}" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label>Pengarang:</label>
            <input type="text" name="pengarang" value="{{ $buku->pengarang }}" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label>Penerbit:</label>
            <input type="text" name="penerbit" value="{{ $buku->penerbit }}" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label>Status:</label>
            <input type="text" name="status" value="{{ $buku->status }}" class="border rounded px-3 py-2 w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
