<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_blogs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('excerpt');
            $table->text('content')->nullable();
            $table->string('image');
            $table->date('published_date');
            $table->string('author_name');
            $table->integer('likes_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->string('read_more_text')->default('Read More');
            $table->string('read_more_link')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}