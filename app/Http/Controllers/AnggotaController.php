<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::query();

        // Cek apakah ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where('idanggota', 'like', '%' . $search . '%')
                  ->orWhere('nama', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%');
        }

        $anggota = $query->paginate(10);

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idanggota' => 'required|unique:tbanggota,idanggota',
            'nama' => 'required|string|max:255',
            'jeniskelamin' => 'required|string|max:10',
            'alamat' => 'required|string|max:255',
            'status' => 'required|string|max:20',
        ]);

        Anggota::create($validated);

        return redirect()->route('anggota.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $anggota = Anggota::where('idanggota', $id)->first();

        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $idanggota)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jeniskelamin' => 'required|string|max:10',
            'alamat' => 'required|string|max:255',
            'status' => 'required|string|max:20',
        ]);

        $anggota = Anggota::where('idanggota', $idanggota)->firstOrFail();
        $anggota->update($validated);

        return redirect()->route('anggota.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data berhasil dihapus.');
    }
}
