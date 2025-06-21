<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reg_regencies', function (Blueprint $table) {
            $table->char('id', 2)->primary();
            $table->string('name');
            $table->char('province_id', 2)->nullable();
            $table->foreign('province_id')->references('id')->on('reg_provinces')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reg_regencies');
    }
};
