<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'tbpeminjaman'; // Pastikan nama tabel sesuai
    protected $primaryKey = 'idpeminjaman'; // Menentukan primary key yang digunakan
    public $incrementing = false; // Menonaktifkan auto increment karena idpeminjaman bukan integer
    public $timestamps = true; // Pastikan timestamps aktif (default sudah true, ini hanya penegasan)
    
    protected $fillable = ['idpeminjaman', 'idanggota', 'idbuku', 'tglpinjam', 'tglkembali']; // Kolom yang bisa diisi
    
    protected $dates = ['created_at', 'updated_at']; // Pastikan Laravel mengenali kolom datetime sebagai Carbon instance

    // Relasi dengan model Anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'idanggota');
    }

    // Relasi dengan model Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'idbuku');
    }
}
