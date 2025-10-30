<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_missing_fields_to_blogs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Add blog_category_id as foreign key
            $table->foreignId('blog_category_id')
                ->nullable()
                ->after('author_name')
                ->constrained('blog_categories')
                ->onDelete('set null');

            // Add slug field (required for SEO)
            $table->string('slug')
                ->nullable()
                ->after('title')
                ->unique();

            // Add status field (draft/published)
            $table->enum('status', ['draft', 'published'])
                ->default('draft')
                ->after('blog_category_id');

            // Add is_featured field
            $table->boolean('is_featured')
                ->default(false)
                ->after('status');

            // Add meta fields for SEO
            $table->string('meta_title')
                ->nullable()
                ->after('read_more_link');

            $table->text('meta_description')
                ->nullable()
                ->after('meta_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Drop foreign key and column
            $table->dropForeign(['blog_category_id']);
            $table->dropColumn('blog_category_id');

            // Drop added columns
            $table->dropColumn(['slug', 'status', 'is_featured', 'meta_title', 'meta_description']);
        });
    }
};