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
        Schema::create('resolutions', function (Blueprint $table) {
            $table->id();

            $table->string('resolution_number', 100)->unique();
            $table->string('title', 500);
            $table->date('date_passed');
            $table->string('author_sponsor', 255);

            $table->text('description')->nullable();
            $table->string('status', 50)->default('adopted'); // e.g adopted, archived 

            $table->timestamps();

            $table->index('title');
            $table->index('date_passed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resolutions');
    }
};
