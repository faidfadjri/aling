<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('region_districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('regency_id')->nullable()->constrained('region_regencies')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('region_districts');
    }
};
