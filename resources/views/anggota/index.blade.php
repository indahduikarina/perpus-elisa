@extends('layouts.app')

@section('content')
<div class="p-4 max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold mb-4 text-pink-700">📋 Data Anggota</h2>

    <div class="flex flex-wrap gap-2 justify-between items-center mb-4">
        <button onclick="openModal()" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600">
            ➕ Tambah Anggota
        </button>

        <form action="{{ route('anggota.index') }}" method="GET" class="flex flex-wrap gap-2">
            <input
                type="text"
                name="search"
                placeholder="Cari anggota..."
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
        <table class="table-auto w-full min-w-[600px]">
            <thead class="bg-pink-100 text-pink-800">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">JK</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggota as $item)
                <tr class="border-t hover:bg-pink-50 transition">
                    <td class="px-4 py-2">{{ $item->idanggota }}</td>
                    <td class="px-4 py-2">{{ $item->nama }}</td>
                    <td class="px-4 py-2">{{ $item->jeniskelamin }}</td>
                    <td class="px-4 py-2">{{ $item->alamat }}</td>
                    <td class="px-4 py-2">{{ $item->status }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <button onclick="openEditModal('{{ $item->idanggota }}', '{{ $item->nama }}', '{{ $item->jeniskelamin }}', '{{ $item->alamat }}', '{{ $item->status }}')" class="text-blue-600 hover:underline">Edit</button>
                        <form action="{{ route('anggota.destroy', $item->idanggota) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin?')" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-pink-500 text-lg font-semibold bg-pink-50">
                        😢 Tidak ada data anggota yang cocok dengan pencarian "{{ request('search') }}"
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $anggota->links() }}</div>
</div>

<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-[90%] sm:max-w-xl p-6 rounded-lg shadow-lg relative border-2 border-pink-300 max-h-screen overflow-y-auto">
        <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-600 hover:text-red-500 text-xl">×</button>
        <h3 class="text-2xl font-bold text-pink-700 mb-4">Tambah Anggota</h3>
        <form action="{{ route('anggota.store') }}" method="POST" class="space-y-4">
            @csrf
            @foreach (['idanggota' => 'ID Anggota', 'nama' => 'Nama', 'alamat' => 'Alamat', 'status' => 'Status'] as $name => $label)
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">{{ $label }}</label>
                @if ($name === 'alamat')
                <textarea name="{{ $name }}" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400" required></textarea>
                @else
                <input type="text" name="{{ $name }}" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400" required>
                @endif
                @error($name)<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            @endforeach
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Jenis Kelamin</label>
                <select name="jeniskelamin" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400" required>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
                @error('jeniskelamin')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
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
        <h3 class="text-2xl font-bold text-pink-700 mb-4">Edit Anggota</h3>
        <form id="formEdit" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <input type="hidden" id="edit_idanggota" name="idanggota">

            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Nama</label>
                <input type="text" id="edit_nama" name="nama" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Jenis Kelamin</label>
                <select id="edit_jeniskelamin" name="jeniskelamin" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400" required>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Alamat</label>
                <textarea id="edit_alamat" name="alamat" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400" required></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-800 mb-1">Status</label>
                <input type="text" id="edit_status" name="status" class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:ring-pink-400" required>
            </div>
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

    function openEditModal(id, nama, jk, alamat, status) {
        document.getElementById('formEdit').action = `/anggota/${id}`;
        document.getElementById('edit_idanggota').value = id;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_jeniskelamin').value = jk;
        document.getElementById('edit_alamat').value = alamat;
        document.getElementById('edit_status').value = status;
        document.getElementById('modalEdit').classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('modalEdit').classList.add('hidden');
    }
</script>
@endsection
