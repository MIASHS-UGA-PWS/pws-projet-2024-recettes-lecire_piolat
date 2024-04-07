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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('set null');
            $table->mediumText('title');
            $table->longText('content');
            $table->string('ingredients')->nullable();
            $table->string('image')->nullable();
            $table->integer('price')->unsigned();
            $table->string('url', 200)->unique('url_UNIQUE');
            $table->string('status', 45)->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
