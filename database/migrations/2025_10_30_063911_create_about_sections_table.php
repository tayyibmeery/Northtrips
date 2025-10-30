<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_about_sections_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description1')->nullable();
            $table->text('description2')->nullable();
            $table->string('image')->nullable();
            $table->string('background_image')->nullable();
            $table->json('features')->nullable(); // Store features as JSON array
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_sections');
    }
}