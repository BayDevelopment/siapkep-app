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
            $table->id('id_residents'); // saran: pakai default id
            $table->string('nik', 16)->unique();
            $table->string('full_name');
            $table->string('birth_place')->nullable();
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->text('address')->nullable();

            $table->foreignId('rt_id')->nullable()->constrained('tb_rts')->nullOnDelete();

            $table->enum('resident_status', ['aktif', 'mutasi', 'meninggal'])->default('aktif');
            $table->date('status_changed_at')->nullable(); // rekomendasi

            $table->timestamps();
            $table->softDeletes();
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
