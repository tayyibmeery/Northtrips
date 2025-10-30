<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_packages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('destination');
            $table->integer('duration_days');
            $table->integer('persons');
            $table->decimal('price', 10, 2);
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->text('description');
            $table->string('image');
            $table->string('hotel_deals_text')->default('Hotel Deals');
            $table->string('read_more_text')->default('Read More');
            $table->string('read_more_link')->nullable();
            $table->string('book_now_text')->default('Book Now');
            $table->string('book_now_link')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}