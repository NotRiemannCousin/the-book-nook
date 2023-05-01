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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('language');

            $table->float('price');
            $table->unsignedInteger('sold');
            $table->unsignedInteger('quantity');

            $table->string('image')->nullable();
            $table->string('weight')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('length')->nullable();
            $table->unsignedInteger('pages')->nullable();

            $table->string('isbn');
            $table->unsignedInteger('year')->nullable();

            $table->foreignId('genre_id')->constrained();
            $table->foreignId('author_id')->constrained();
            $table->foreignId('publisher_id')->constrained();
            // $table->foreignId('sale_id')->nullable()->constrained();

            $table->unsignedInteger('rating_1');
            $table->unsignedInteger('rating_2');
            $table->unsignedInteger('rating_3');
            $table->unsignedInteger('rating_4');
            $table->unsignedInteger('rating_5');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
