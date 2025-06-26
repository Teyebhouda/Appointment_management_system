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
    Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable();
        $table->string('email')->nullable()->unique();
        $table->string('phone')->nullable();
        $table->string('password')->nullable();

        // Adresse complète dans le même modèle
        $table->string('address')->nullable();
        $table->string('postal_code')->nullable();
        $table->string('city')->nullable();
        $table->string('state')->nullable();
        $table->string('country')->nullable();

        $table->string('gender')->nullable(); // male, female, other
        $table->boolean('is_active')->default(true);

        $table->timestamps(); // created_at and updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            Schema::dropIfExists('clients');

            //
        });
    }
};
