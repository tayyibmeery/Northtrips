<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->text('company_links')->nullable()->comment('JSON array of company links');
            $table->text('support_links')->nullable()->comment('JSON array of support links');
            $table->text('payment_methods')->nullable()->comment('JSON array of payment methods');
            $table->text('languages')->nullable()->comment('JSON array of languages');
            $table->text('currencies')->nullable()->comment('JSON array of currencies');
            $table->string('default_language')->default('English');
            $table->string('default_currency')->default('USD');
            $table->string('copyright_text')->nullable();
            $table->boolean('show_designer_credit')->default(true);
            $table->boolean('show_back_to_top')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
