<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('judulbuku','like',"%{$s}%")
                  ->orWhere('kategori','like',"%{$s}%")
                  ->orWhere('pengarang','like',"%{$s}%");
        }
        $buku = $query->orderBy('idbuku','desc')->paginate(10);
        return view('buku.index', compact('buku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idbuku'       => 'required|string|max:5|unique:tbbuku,idbuku',
            'judulbuku'    => 'required|string|max:50',
            'kategori'     => 'required|string|max:50',
            'pengarang'    => 'required|string|max:40',
            'penerbit'     => 'required|string|max:40',
            'tahunterbit'  => 'required|integer|min:1000|max:'.now()->year,
            'status'       => 'required|string|max:10',
        ]);

        Buku::create($validated);
        return redirect()->route('buku.index')->with('success','Data buku berhasil ditambahkan.');
    }

    public function update(Request $request, $idbuku)
    {
        $validated = $request->validate([
            'judulbuku'    => 'required|string|max:50',
            'kategori'     => 'required|string|max:50',
            'pengarang'    => 'required|string|max:40',
            'penerbit'     => 'required|string|max:40',
            'tahunterbit'  => 'required|integer|min:1000|max:'.now()->year,
            'status'       => 'required|string|max:10',
        ]);

        Buku::where('idbuku',$idbuku)->update($validated);
        return redirect()->route('buku.index')->with('success','Data buku berhasil diupdate.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('success','Data buku berhasil dihapus.');
    }
}
