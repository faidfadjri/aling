<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->text('description');
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->foreignId('outlet_id')->constrained('outlets')->onDelete('cascade');
            $table->integer('stock')->unsigned()->default(0)->comment('min: 0');
            $table->decimal('price', 10, 2);
            $table->integer('discount')->default(0)->comment('discount in %');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
