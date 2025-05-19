<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'tbbuku';
    protected $primaryKey = 'idbuku';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'idbuku',
        'judulbuku',
        'kategori',
        'pengarang',
        'penerbit',
        'tahunterbit',
        'status',
    ];
}
