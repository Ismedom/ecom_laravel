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
        Schema::create('save_shop', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('shop')->onDelete('cascade');
            $table->string('shop_profile_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('save_shop');
    }
};