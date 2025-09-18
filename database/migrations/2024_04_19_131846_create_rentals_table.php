<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Books;
use App\Models\User;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Migration'ı çalıştır.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('book_id');
            // $table->unsignedBigInteger('user_id');

            // $table->foreign('book_id')->references('id')->on('books')->constrained()->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');

            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('book_id')->constrained()->onDelete('cascade');

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Books::class)->constrained()->cascadeOnDelete();

            $table->string('status');
            $table->timestamp('rental_requested_at')->useCurrent();
            $table->timestamp('rental_start_at')->nullable();
            $table->timestamp('rental_due_at')->nullable();
            $table->timestamp('returned_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Migration'ı geri al.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
