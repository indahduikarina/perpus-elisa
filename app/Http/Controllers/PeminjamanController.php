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
        $peminjaman = Peminjaman::with('anggota','buku')
            ->when($search, fn($q) => $q->whereHas('anggota', fn($q2) =>
                  $q2->where('nama','like',"%{$search}%"))
                ->orWhereHas('buku', fn($q3) =>
                  $q3->where('judulbuku','like',"%{$search}%")) )
            ->orderBy('tglpinjam','desc')->paginate(10);

        $anggota = Anggota::all();
        $buku    = Buku::all();
        return view('peminjaman.index', compact('peminjaman','anggota','buku'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'idpeminjaman'=>'required|unique:tbpeminjaman,idpeminjaman',
            'idanggota'   =>'required',
            'idbuku'      =>'required',
            'tglpinjam'   =>'required|date',
            'tglkembali'  =>'required|date|after_or_equal:tglpinjam',
        ]);
        Peminjaman::create($r->all());
        return back()->with('success','Ditambahkan.');
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'idanggota'  =>'required',
            'idbuku'     =>'required',
            'tglpinjam'  =>'required|date',
            'tglkembali' =>'required|date|after_or_equal:tglpinjam',
        ]);
        Peminjaman::findOrFail($id)->update($r->all());
        return back()->with('success','Diubah.');
    }

    public function destroy($id)
    {
        Peminjaman::destroy($id);
        return back()->with('success','Dihapus.');
    }

    public function laporan()
    {
        $data = Peminjaman::with('anggota','buku')
            ->orderBy('tglpinjam','desc')->get();

        // Ubah nama view di sini:
        $html = view('peminjaman.laporanpinjam', compact('data'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('laporan_peminjaman.pdf','I');
    }
}
