<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration'ı çalıştır.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('author');
            $table->date('release_date');
            $table->integer('pages');
            $table->string('isbn');
            $table->text('description');
            // $table->string('genre');
            $table->integer('in_stock');
            $table->text('cover');
            $table->string('language');

            $table->timestamps();
        });
    }

    /**
     * Migration'ı geri al.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
