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
        Schema::table('services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Nom du service, ex : Consultation');
            $table->text('description')->nullable()->comment('Description du service');
            $table->decimal('price', 8, 2)->default(0)->comment('Prix du service, 0 si gratuit');
            $table->boolean('active')->default(true)->comment('Le service est-il actif ?');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            //
        });
    }
};
