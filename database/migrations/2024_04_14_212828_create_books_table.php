<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('authors', 255);
            $table->unsignedBigInteger('genre_id')->nullable();
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->text('description')->nullable();
            $table->date('released_at')->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->integer('pages');
            $table->string('language_code', 3)->default('hu');
            $table->string('isbn', 13)->unique();
            $table->integer('in_stock');
            $table->timestamps();

        });
    }
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
