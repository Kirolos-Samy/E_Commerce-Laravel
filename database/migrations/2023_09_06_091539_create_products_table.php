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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc')->nullable();
            $table->float('cost_price');
            $table->float('sell_price');
            $table->integer('quantity');
            $table->string('tags')->nullable();
            $table->string('image');
            $table->foreignId('category_id')->constrained();
            $table->tinyInteger('active')->default(1);  // 1 represents active, 0 represents inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
