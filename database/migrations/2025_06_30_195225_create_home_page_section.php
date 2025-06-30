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
        Schema::create('home_page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique()->comment('Unique key for the section');
            $table->json('content')->nullable()->comment('Content of the section in JSON format');
            $table->timestamps(0)->comment('Timestamps for created_at and updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_page_sections', function (Blueprint $table) {
            $table->dropColumn(['id', 'section_key', 'content']);
            $table->dropTimestamps();

        });
    }
};
