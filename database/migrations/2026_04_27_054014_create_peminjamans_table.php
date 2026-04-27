<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
                
            $table->foreignId('buku_id')
                ->constrained('bukus')
                ->cascadeOnDelete();

            // tanggal pinjam
            $table->date('tanggal_pinjam');

            // jatuh tempo
            $table->date('jatuh_tempo')->nullable();

            // status peminjaman
            $table->enum('status', ['dipinjam','dikembalikan'])
                ->default('dipinjam');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
