<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('save_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->unsignedBigInteger('user_saved_id');
            $table->foreign('user_saved_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('author');
            $table->decimal('price', 8, 2);
            $table->float('rating', 3, 1)->nullable();
            $table->text('description');
            $table->string('coverImageUrl');
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