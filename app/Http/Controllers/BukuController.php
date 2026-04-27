<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with(['penulis','kategori'])->get();
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $penulis = Penulis::all();
        $kategori = Kategori::all();

        return view('buku.create', compact('penulis','kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis_id' => 'required|exists:penulis,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required|integer',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')
            ->with('success','Buku berhasil ditambahkan');
    }

    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $penulis = Penulis::all();
        $kategori = Kategori::all();

        return view('buku.edit', compact('buku','penulis','kategori'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required',
            'penulis_id' => 'required|exists:penulis,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required|integer',
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')
            ->with('success','Buku berhasil diupdate');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success','Buku berhasil dihapus');
    }
}