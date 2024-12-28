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
        Schema::create('save_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_saved_id');
            $table->foreign('user_saved_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->string('category');
            $table->float('price');
            $table->string('currency');
            $table->string('product_id');
            $table->string('product_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('save_product');
    }
};