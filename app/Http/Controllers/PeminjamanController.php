<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan data peminjaman
     */
    public function index()
    {
        $peminjaman = Peminjaman::with(['user','buku'])->latest()->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Form pinjam buku
     */
    public function create()
    {
        $bukus = Buku::all();
        return view('peminjaman.create', compact('bukus'));
    }

    /**
     * Simpan peminjaman
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        // cek stok
        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => now(),
            'jatuh_tempo' => now()->addDays(7),
            'status' => 'dipinjam',
        ]);

        // kurangi stok
        $buku->decrement('stok');

        return redirect()->route('peminjaman.index')
            ->with('success','Buku berhasil dipinjam');
    }

    /**
     * Detail peminjaman
     */
    public function show(Peminjaman $peminjaman)
    {
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Form edit (jarang dipakai)
     */
    public function edit(Peminjaman $peminjaman)
    {
        return view('peminjaman.edit', compact('peminjaman'));
    }

    /**
     * Update peminjaman
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')
            ->with('success','Data peminjaman diupdate');
    }

    /**
     * Hapus peminjaman
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success','Data peminjaman dihapus');
    }
}