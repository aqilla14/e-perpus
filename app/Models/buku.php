<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';

    protected $fillable = [
        'judul',
        'penulis_id',
        'kategori_id',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'edisi',
        'jumlah_halaman',
        'ukuran',
        'stok',
        'deskripsi',
    ];

    public function penulis()
    {
        return $this->belongsTo(Penulis::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}