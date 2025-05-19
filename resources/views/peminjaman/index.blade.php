@extends('layouts.app')

@section('content')
<div class="p-4 max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold mb-4 text-pink-700">📋 Data Peminjaman</h2>

    <!-- Kontrol: Tambah, Cetak, Search -->
    <div class="flex flex-wrap items-center gap-2 mb-4">
        <!-- Tombol Tambah -->
        <button onclick="openModalTambah()" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">
            ➕ Tambah Peminjaman
        </button>

        <!-- Tombol Cetak -->
        <a href="{{ route('peminjaman.laporan') }}" target="_blank"
           class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700">
            📄 Cetak Laporan
        </a>

        <!-- Form Search -->
        <form action="{{ route('peminjaman.index') }}" method="GET" class="ml-auto flex gap-2 w-full md:w-auto">
            <input type="text" name="search" placeholder="Cari peminjaman..." value="{{ request('search') }}"
                   class="w-full md:w-80 px-4 py-2 rounded-lg border border-pink-300 bg-pink-50 placeholder-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-400">
            <button type="submit"
                    class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">
                🔍
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel -->
    <div class="overflow-x-auto bg-white shadow rounded-lg border border-pink-200">
        <table class="min-w-max w-full table-auto">
            <thead class="bg-pink-100 text-pink-800">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Anggota</th>
                    <th class="px-4 py-2">Buku</th>
                    <th class="px-4 py-2">Tgl Pinjam</th>
                    <th class="px-4 py-2">Tgl Kembali</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $item)
                <tr class="border-t hover:bg-pink-50 transition">
                    <td class="px-4 py-2">{{ $item->idpeminjaman }}</td>
                    <td class="px-4 py-2">{{ $item->anggota->nama ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $item->buku->judulbuku ?? '-' }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tglpinjam)->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tglkembali)->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <button onclick="openModalEdit(
                            '{{ $item->idpeminjaman }}',
                            '{{ $item->idanggota }}',
                            '{{ $item->idbuku }}',
                            '{{ $item->tglpinjam }}',
                            '{{ $item->tglkembali }}')"
                            class="text-blue-600 hover:underline">Edit</button>
                        <form action="{{ route('peminjaman.destroy', $item->idpeminjaman) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin?')" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-pink-500 text-lg font-semibold bg-pink-50">
                        😢 Tidak ada data yang cocok dengan pencarian "{{ request('search') }}"
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $peminjaman->links() }}</div>
</div>
@endsection
