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
        Schema::create('tb_rts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rw_id')->constrained('tb_rws')->cascadeOnDelete();
            $table->string('no_rt', 3); // contoh: 01, 02
            $table->string('name')->nullable(); // opsional: nama RT / ketua RT

            $table->unique(['rw_id', 'no_rt']); // RT unik per RW
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rts');
    }
};
