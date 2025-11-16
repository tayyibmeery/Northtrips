<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('itinerary_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerary_template_id')->constrained()->onDelete('cascade');
            $table->integer('day_number');
            $table->string('title');
            $table->text('description');
            $table->text('activities')->nullable();
            $table->text('meals')->nullable();
            $table->text('accommodation')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            // Index for better performance
            $table->index(['itinerary_template_id', 'day_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itinerary_days');
    }
};
