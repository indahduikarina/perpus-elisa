<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'tbanggota';
    protected $primaryKey = 'idanggota';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true; // <-- Tambahkan baris ini!

    protected $fillable = ['idanggota', 'nama', 'jeniskelamin', 'alamat', 'status'];

    public function getRouteKeyName()
    {
        return 'idanggota';
    }
}
