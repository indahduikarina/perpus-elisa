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
        Schema::create('tbpeminjaman', function (Blueprint $table) {
            $table->string('idpeminjaman', 5)->primary();
            $table->string('idanggota', 5);
            $table->string('idbuku', 5);
            $table->date('tglpinjam');
            $table->date('tglkembali');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Foreign key constraints
            $table->foreign('idanggota')->references('idanggota')->on('tbanggota')->onDelete('cascade');
            $table->foreign('idbuku')->references('idbuku')->on('tbbuku')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbpeminjaman');
    }
};
