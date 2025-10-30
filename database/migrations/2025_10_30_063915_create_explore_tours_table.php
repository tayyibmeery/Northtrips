<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_explore_tours_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExploreToursTable extends Migration
{
    public function up()
    {
        Schema::create('explore_tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('tour_categories');
            $table->string('title');
            $table->string('image');
            $table->integer('cities_count')->nullable();
            $table->integer('tour_places_count')->nullable();
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->string('button_text')->default('View All Place');
            $table->string('button_link')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('explore_tours');
    }
}