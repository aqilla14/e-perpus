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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();

            $table->string('judul');

            $table->foreignId('penulis_id')
                  ->constrained('penulis')
                  ->cascadeOnDelete();

            $table->string('penerbit');
            $table->year('tahun_terbit');

            $table->string('isbn')->unique()->nullable();
            $table->string('edisi')->nullable();
            $table->integer('jumlah_halaman')->nullable();
            $table->string('ukuran')->nullable();

            $table->foreignId('kategori_id')
                  ->constrained('kategoris')
                  ->cascadeOnDelete();

            $table->integer('stok')->default(0);
            $table->text('deskripsi')->nullable();

            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
