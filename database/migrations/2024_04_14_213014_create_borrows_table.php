<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reader_id')->constrained('users');
            $table->foreignId('book_id')->constrained('books');
            $table->enum('status', ['PENDING', 'ACCEPTED', 'REJECTED', 'RETURNED']);
            $table->dateTime('request_processed_at')->nullable();
            $table->foreignId('request_managed_by')->nullable()->constrained('users');
            $table->dateTime('deadline')->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->foreignId('return_managed_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
