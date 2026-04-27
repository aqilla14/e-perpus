<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Tampilkan data pengembalian
     */
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.buku')->latest()->get();
        return view('pengembalian.index', compact('pengembalians'));
    }

    /**
     * Proses pengembalian buku
     */
    public function store($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        // hitung denda (misal 1000 per hari telat)
        $denda = 0;

        if (now()->gt($peminjaman->jatuh_tempo)) {
            $telat = now()->diffInDays($peminjaman->jatuh_tempo);
            $denda = $telat * 1000;
        }

        // simpan pengembalian
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_kembali' => now(),
            'denda' => $denda,
        ]);

        // update status peminjaman
        $peminjaman->update([
            'status' => 'dikembalikan'
        ]);

        // kembalikan stok buku
        $peminjaman->buku->increment('stok');

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan');
    }

    /**
     * Detail pengembalian
     */
    public function show(Pengembalian $pengembalian)
    {
        return view('pengembalian.show', compact('pengembalian'));
    }

    /**
     * Hapus data (optional)
     */
    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();

        return back()->with('success', 'Data pengembalian dihapus');
    }
}