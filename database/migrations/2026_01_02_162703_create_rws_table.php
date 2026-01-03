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
        Schema::create('tb_rws', function (Blueprint $table) {
            $table->id();
            $table->string('no_rw', 3); // contoh: 01, 02
            $table->string('name')->nullable(); // opsional: nama RW / ketua RW

            $table->unique('no_rw');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rws');
    }
};
