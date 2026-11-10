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
        Schema::create('ordinances', function (Blueprint $table) {
            $table->id();
            $table->string('ordinance_number', 100)->unique();
            $table->string('title', 500);
            $table->date('date_passed');
            $table->string('author_sponsor', 255);

            $table->text('description')->nullable();
            $table->string('status', 50)->default('active'); // e.g active, ammended, repealed

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
        Schema::dropIfExists('ordinances');
    }
};
