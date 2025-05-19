@extends('layouts.app')

@section('content')
<div class="p-4 max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold mb-4 text-pink-700">📋 Data Peminjaman</h2>

    <div class="flex flex-wrap gap-2 justify-between items-center mb-4">
        <button onclick="openTambahModal()" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">
            ➕ Tambah Peminjaman
        </button>

        <a href="{{ route('peminjaman.laporan') }}" target="_blank"
           class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700">
            📄 Cetak Laporan
        </a>

        <form action="{{ route('peminjaman.index') }}" method="GET" class="flex gap-2">
            <input
                type="text"
                name="search"
                placeholder="Cari peminjaman..."
                value="{{ request('search') }}"
                class="w-full sm:w-64 px-4 py-2 rounded-lg border border-pink-300 bg-pink-50 placeholder-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-400"
            >
            <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">
                Search
            </button>
        </form>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg border border-pink-200">
        <table class="table-auto w-full min-w-[600px]">
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
                        <button
                            onclick="openEditModal('{{ $item->idpeminjaman }}','{{ $item->idanggota }}','{{ $item->idbuku }}','{{ $item->tglpinjam }}','{{ $item->tglkembali }}')"
                            class="text-blue-600 hover:underline"
                        >Edit</button>

                        <form action="{{ route('peminjaman.destroy', $item->idpeminjaman) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin ingin hapus?')" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-pink-500 text-lg font-semibold bg-pink-50">
                        😢 Tidak ada data peminjaman yang cocok dengan pencarian "{{ request('search') }}"
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $peminjaman->links() }}</div>
</div>

<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-[90%] sm:max-w-xl p-6 rounded-lg shadow-lg relative border-2 border-pink-300 max-h-screen overflow-y-auto">
        <button onclick="closeTambahModal()" class="absolute top-2 right-3 text-gray-600 hover:text-red-500 text-xl">×</button>
        <h3 class="text-2xl font-bold text-pink-700 mb-4">Tambah Peminjaman</h3>

        <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">ID Peminjaman</label>
                <input type="text" name="idpeminjaman" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400" required>
                @error('idpeminjaman')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Anggota</label>
                <select name="idanggota" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400">
                    @foreach($anggota as $a)
                        <option value="{{ $a->idanggota }}">{{ $a->nama }}</option>
                    @endforeach
                </select>
                @error('idanggota')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Buku</label>
                <select name="idbuku" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400">
                    @foreach($buku as $b)
                        <option value="{{ $b->idbuku }}">{{ $b->judulbuku }}</option>
                    @endforeach
                </select>
                @error('idbuku')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Tanggal Pinjam</label>
                <input type="date" name="tglpinjam" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400">
                @error('tglpinjam')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Tanggal Kembali</label>
                <input type="date" name="tglkembali" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400">
                @error('tglkembali')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex justify-end space-x-2 pt-4">
                <button type="button" onclick="closeTambahModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded hover:bg-pink-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-[90%] sm:max-w-xl p-6 rounded-lg shadow-lg relative border-2 border-pink-300 max-h-screen overflow-y-auto">
        <button onclick="closeEditModal()" class="absolute top-2 right-3 text-gray-600 hover:text-red-500 text-xl">×</button>
        <h3 class="text-2xl font-bold text-pink-700 mb-4">Edit Peminjaman</h3>

        <form id="formEdit" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <input type="hidden" id="edit_idpeminjaman" name="idpeminjaman">

            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Anggota</label>
                <select id="edit_idanggota" name="idanggota" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400"></select>
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Buku</label>
                <select id="edit_idbuku" name="idbuku" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400"></select>
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Tanggal Pinjam</label>
                <input type="date" id="edit_tglpinjam" name="tglpinjam" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Tanggal Kembali</label>
                <input type="date" id="edit_tglkembali" name="tglkembali" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400">
            </div>
            <div class="flex justify-end space-x-2 pt-4">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded hover:bg-pink-600">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTambahModal() {
        document.getElementById('modalTambah').classList.remove('hidden');
    }
    function closeTambahModal() {
        document.getElementById('modalTambah').classList.add('hidden');
    }

    function openEditModal(id, idanggota, idbuku, tglpinjam, tglkembali) {
        document.getElementById('modalEdit').classList.remove('hidden');
        document.getElementById('edit_idpeminjaman').value = id;

        // Populate dropdowns
        const anggotaSelect = document.getElementById('edit_idanggota');
        anggotaSelect.value = idanggota;

        const bukuSelect = document.getElementById('edit_idbuku');
        bukuSelect.value = idbuku;

        document.getElementById('edit_tglpinjam').value = tglpinjam;
        document.getElementById('edit_tglkembali').value = tglkembali;

        document.getElementById('formEdit').action = `/peminjaman/${id}`;
    }
    function closeEditModal() {
        document.getElementById('modalEdit').classList.add('hidden');
    }
</script>
@endsection
