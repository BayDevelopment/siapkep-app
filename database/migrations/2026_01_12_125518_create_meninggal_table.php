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
        Schema::create('tb_meninggal', function (Blueprint $table) {
            $table->id('id_meninggal');

            $table->foreignId('resident_id')
                ->constrained('tb_residents', 'id_residents')
                ->onDelete('cascade')
                ->unique(); // ✅ 1 resident cuma boleh 1 data meninggal (hapus kalau tidak mau)

            $table->date('death_date');
            $table->string('death_place')->nullable();
            $table->string('cause_of_death')->nullable();
            $table->text('notes')->nullable();

            // ✅ path surat meninggal (pdf/jpg/png) di storage
            $table->string('death_certificate_path')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_meninggal');
    }
};
