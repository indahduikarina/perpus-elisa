@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Peminjaman</h1>

    <form action="{{ route('peminjaman.update', $peminjaman->idpeminjaman) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>ID Peminjaman</label>
            <input type="text" name="idpeminjaman" class="form-control" value="{{ $peminjaman->idpeminjaman }}" readonly>
        </div>

        <div class="mb-3">
            <label>Nama Anggota</label>
            <select name="idanggota" class="form-control" required>
                @foreach($anggota as $a)
                    <option value="{{ $a->idanggota }}" {{ $peminjaman->idanggota == $a->idanggota ? 'selected' : '' }}>
                        {{ $a->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul Buku</label>
            <select name="idbuku" class="form-control" required>
                @foreach($buku as $b)
                    <option value="{{ $b->idbuku }}" {{ $peminjaman->idbuku == $b->idbuku ? 'selected' : '' }}>
                        {{ $b->judulbuku }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tglpinjam" class="form-control" value="{{ $peminjaman->tglpinjam }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="date" name="tglkembali" class="form-control" value="{{ $peminjaman->tglkembali }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
