<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookGenreTable extends Migration
{
    public function up()
    {
        Schema::create('book_genre', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('genre_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->primary(['book_id', 'genre_id']); // Composite primary key
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_genre');
    }
}
