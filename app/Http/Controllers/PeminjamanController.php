<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Mpdf\Mpdf;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $peminjaman = Peminjaman::with('anggota', 'buku')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('anggota', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('buku', function ($q) use ($search) {
                    $q->where('judulbuku', 'like', "%{$search}%");
                });
            })
            ->orderBy('tglpinjam', 'desc')
            ->paginate(10);

        $anggota = Anggota::all();
        $buku = Buku::all();

        return view('peminjaman.index', compact('peminjaman', 'anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpeminjaman' => 'required|unique:tbpeminjaman,idpeminjaman',
            'idanggota' => 'required|exists:tbanggota,idanggota',
            'idbuku' => 'required|exists:tbbuku,idbuku',
            'tglpinjam' => 'required|date',
            'tglkembali' => 'required|date|after_or_equal:tglpinjam',
        ]);

        Peminjaman::create($request->all());

        return back()->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idanggota' => 'required|exists:tbanggota,idanggota',
            'idbuku' => 'required|exists:tbbuku,idbuku',
            'tglpinjam' => 'required|date',
            'tglkembali' => 'required|date|after_or_equal:tglpinjam',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($request->all());

        return back()->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Peminjaman::destroy($id);
        return back()->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function laporan()
    {
        $data = Peminjaman::with('anggota', 'buku')
            ->orderBy('tglpinjam', 'desc')
            ->get();

        $html = view('peminjaman.laporanpinjam', compact('data'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('laporan_peminjaman.pdf', 'I');
    }
}
