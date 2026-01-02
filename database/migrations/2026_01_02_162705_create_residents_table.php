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
        Schema::create('tb_residents', function (Blueprint $table) {
            $table->id('id_residents');
            $table->string('nik', 16)->unique();
            $table->string('full_name');
            $table->string('birth_place')->nullable();
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->text('address')->nullable();

            // versi simple dulu: simpan rt/rw sebagai string atau integer
            $table->string('rw', 3)->nullable();
            $table->string('rt', 3)->nullable();
            $table->enum('status', ['aktif', 'pindah', 'meninggal'])->default('aktif');

            $table->timestamps();
            $table->softDeletes(); // biar aman (hapus = masuk trash dulu)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_residents');
    }
};
