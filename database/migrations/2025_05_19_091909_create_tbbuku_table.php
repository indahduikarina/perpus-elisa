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
        Schema::create('tbbuku', function (Blueprint $table) {
            $table->string('idbuku', 5)->primary();
            $table->string('judulbuku', 50);
            $table->string('kategori', 50);
            $table->string('pengarang', 40);
            $table->string('penerbit', 40);
            $table->integer('tahunterbit')->nullable();
            $table->string('status', 10);
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbbuku');
    }
};
