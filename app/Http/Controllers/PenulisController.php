<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    /**
     * Tampilkan semua penulis
     */
    public function index()
    {
        $penulis = Penulis::latest()->get();
        return view('penulis.index', compact('penulis'));
    }

    /**
     * Form tambah penulis
     */
    public function create()
    {
        return view('penulis.create');
    }

    /**
     * Simpan penulis
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
        ]);

        Penulis::create($request->all());

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil ditambahkan');
    }

    /**
     * Detail penulis
     */
    public function show(Penulis $penulis)
    {
        return view('penulis.show', compact('penulis'));
    }

    /**
     * Form edit
     */
    public function edit(Penulis $penulis)
    {
        return view('penulis.edit', compact('penulis'));
    }

    /**
     * Update penulis
     */
    public function update(Request $request, Penulis $penulis)
    {
        $request->validate([
            'nama' => 'required|max:100',
        ]);

        $penulis->update($request->all());

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil diupdate');
    }

    /**
     * Hapus penulis
     */
    public function destroy(Penulis $penulis)
    {
        $penulis->delete();

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil dihapus');
    }
}