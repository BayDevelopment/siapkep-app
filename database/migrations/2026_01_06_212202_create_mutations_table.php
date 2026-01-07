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
        Schema::create('tb_mutations', function (Blueprint $table) {
            $table->id('id_mutations');
            $table->foreignId('resident_id')->constrained('tb_residents', 'id_residents')->onDelete('cascade');
            $table->enum('mutation_type', ['pindah antar RT/RW', 'pindah keluar wilayah']);
            $table->date('mutation_date');
            $table->text('old_address')->nullable(); // Alamat sebelumnya
            $table->text('new_address')->nullable(); // Alamat baru
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_mutations');
    }
};
