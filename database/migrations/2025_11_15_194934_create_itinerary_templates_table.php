<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('itinerary_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('trip_code')->unique();
            $table->enum('season', ['summer', 'winter', 'spring', 'autumn', 'year_round', 'eid_special']);
            $table->integer('duration_days');
            $table->integer('duration_nights');
            $table->text('description');

            // JSON fields for selected components
            $table->json('selected_included_services')->nullable();
            $table->json('selected_excluded_services')->nullable();
            $table->json('selected_experience_highlights')->nullable();
            $table->json('selected_important_information')->nullable();
            $table->json('selected_quick_facts')->nullable();

            $table->json('pricing_options');
            $table->text('payment_terms')->nullable();
            $table->text('cancellation_policy')->nullable();
            $table->text('terms_conditions')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('featured')->default(false);
            $table->string('cover_image')->nullable();
            $table->string('pdf_template')->default('default');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itinerary_templates');
    }
};
