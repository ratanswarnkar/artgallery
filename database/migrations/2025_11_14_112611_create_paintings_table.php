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
        Schema::create('paintings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        $table->unsignedBigInteger('artist_id')->nullable();
        $table->unsignedBigInteger('category_id')->nullable();
        $table->unsignedBigInteger('gallery_id')->nullable();
        $table->text('description')->nullable();
        $table->decimal('price', 12, 2)->nullable();
        $table->string('image')->nullable(); // store path like uploads/paintings/xxxx.jpg (public disk)
        $table->enum('status', ['active','inactive','sold'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paintings');
    }
};
