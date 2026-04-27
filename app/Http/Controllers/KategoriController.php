<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Tampilkan semua kategori
     */
    public function index()
    {
        $kategoris = Kategori::latest()->get();
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Simpan kategori
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'deskripsi' => 'nullable',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Detail kategori (optional)
     */
    public function show(Kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Form edit
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'deskripsi' => 'nullable',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Hapus kategori
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}