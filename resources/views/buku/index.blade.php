@extends('layouts.app')

@section('content')
<div class="p-4 max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold mb-4 text-pink-700">📚 Data Buku</h2>

    <div class="flex flex-wrap gap-2 justify-between items-center mb-4">
        <button onclick="openModal()" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">
            ➕ Tambah Buku
        </button>

        <form action="{{ route('buku.index') }}" method="GET" class="flex flex-wrap gap-2">
            <input
                type="text"
                name="search"
                placeholder="Cari buku..."
                value="{{ request('search') }}"
                class="w-full sm:w-64 px-4 py-2 rounded-lg border border-pink-300 bg-pink-50 placeholder-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-400"
            >
            <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">
                Search
            </button>
        </form>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg border border-pink-200">
        <table class="table-auto w-full min-w-[800px]">
            <thead class="bg-pink-100 text-pink-800">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Kategori</th>
                    <th class="px-4 py-2">Pengarang</th>
                    <th class="px-4 py-2">Penerbit</th>
                    <th class="px-4 py-2">Tahun Terbit</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($buku as $item)
                <tr class="border-t hover:bg-pink-50 transition">
                    <td class="px-4 py-2">{{ $item->idbuku }}</td>
                    <td class="px-4 py-2">{{ $item->judulbuku }}</td>
                    <td class="px-4 py-2">{{ $item->kategori }}</td>
                    <td class="px-4 py-2">{{ $item->pengarang }}</td>
                    <td class="px-4 py-2">{{ $item->penerbit }}</td>
                    <td class="px-4 py-2">{{ $item->tahunterbit }}</td>
                    <td class="px-4 py-2">{{ $item->status }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <button onclick="openEditModal(
                            '{{ $item->idbuku }}',
                            '{{ $item->judulbuku }}',
                            '{{ $item->kategori }}',
                            '{{ $item->pengarang }}',
                            '{{ $item->penerbit }}',
                            '{{ $item->tahunterbit }}',
                            '{{ $item->status }}'
                        )" class="text-blue-600 hover:underline">Edit</button>
                        <form action="{{ route('buku.destroy', $item->idbuku) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin?')" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-6 text-pink-500 text-lg font-semibold bg-pink-50">
                        😢 Tidak ada data buku yang cocok dengan pencarian "{{ request('search') }}"
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $buku->links() }}</div>
</div>

<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-[90%] sm:max-w-xl p-6 rounded-lg shadow-lg relative border-2 border-pink-300 max-h-screen overflow-y-auto">
        <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-600 hover:text-red-500 text-xl">×</button>
        <h3 class="text-2xl font-bold text-pink-700 mb-4">Tambah Buku</h3>
        <form action="{{ route('buku.store') }}" method="POST" class="space-y-4">
            @csrf
            @foreach ([
                'idbuku' => 'ID Buku',
                'judulbuku' => 'Judul Buku',
                'kategori' => 'Kategori',
                'pengarang' => 'Pengarang',
                'penerbit' => 'Penerbit',
                'tahunterbit' => 'Tahun Terbit',
                'status' => 'Status'
            ] as $name => $label)
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">{{ $label }}</label>
                <input type="text" name="{{ $name }}" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400" required>
                @error($name)<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            @endforeach
            <div class="flex justify-end space-x-2 pt-4">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded hover:bg-pink-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-[90%] sm:max-w-xl p-6 rounded-lg shadow-lg relative border-2 border-pink-300 max-h-screen overflow-y-auto">
        <button onclick="closeEditModal()" class="absolute top-2 right-3 text-gray-600 hover:text-red-500 text-xl">×</button>
        <h3 class="text-2xl font-bold text-pink-700 mb-4">Edit Buku</h3>
        <form id="formEdit" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <input type="hidden" id="edit_idbuku" name="idbuku">
            @foreach (['judulbuku', 'kategori', 'pengarang', 'penerbit', 'tahunterbit', 'status'] as $name)
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">{{ ucfirst($name) }}</label>
                <input type="text" id="edit_{{ $name }}" name="{{ $name }}" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400" required>
            </div>
            @endforeach
            <div class="flex justify-end space-x-2 pt-4">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded hover:bg-pink-600">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modalTambah').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('modalTambah').classList.add('hidden');
    }

    function openEditModal(id, judulbuku, kategori, pengarang, penerbit, tahunterbit, status) {
        document.getElementById('formEdit').action = `/buku/${id}`;
        document.getElementById('edit_idbuku').value = id;
        document.getElementById('edit_judulbuku').value = judulbuku;
        document.getElementById('edit_kategori').value = kategori;
        document.getElementById('edit_pengarang').value = pengarang;
        document.getElementById('edit_penerbit').value = penerbit;
        document.getElementById('edit_tahunterbit').value = tahunterbit;
        document.getElementById('edit_status').value = status;
        document.getElementById('modalEdit').classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('modalEdit').classList.add('hidden');
    }
</script>
@endsection
