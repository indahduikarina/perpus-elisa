@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Peminjaman</h1>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>ID Peminjaman</label>
            <input type="text" name="idpeminjaman" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Anggota</label>
            <select name="idanggota" class="form-control" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach($anggota as $a)
                    <option value="{{ $a->idanggota }}">{{ $a->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul Buku</label>
            <select name="idbuku" class="form-control" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($buku as $b)
                    <option value="{{ $b->idbuku }}">{{ $b->judulbuku }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tglpinjam" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="date" name="tglkembali" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
