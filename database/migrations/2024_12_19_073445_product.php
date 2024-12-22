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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('shop')->onDelete('cascade');
            $table->unsignedBigInteger('user_owner_id');
            $table->foreign('user_owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('category');
            $table->json('keywords')->nullable();
            $table->string('language')->nullable();
            $table->float('price');
            $table->string('image_base_url');
            $table->float('average_rating')->nullable();
            $table->integer('view_count')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};