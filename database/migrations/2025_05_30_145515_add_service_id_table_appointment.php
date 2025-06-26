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
        // Step 1: Add the service_id column as nullable, without foreign key constraint
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('service_id')
                ->nullable()
                ->after('user_id')
                ->comment('ID du service associé à ce rendez-vous');
            $table->string('status')->default('pending')->comment('Statut du rendez-vous : pending, confirmed, cancelled, completed');
            $table->timestamp('completed_at')->nullable()->comment('Date et heure de la complétion du rendez-vous');
            $table->timestamp('cancelled_at')->nullable()->comment('Date et heure de l\'annulation du rendez-vous');
            $table->timestamp('confirmed_at')->nullable()->comment('Date et heure de la confirmation du rendez-vous');
            $table->timestamp('pending_at')->nullable()->comment('Date et heure de la mise en attente du rendez-vous');
            $table->timestamps();
            $table->index(['service_id', 'status'], 'appointments_service_status_index');       
        });

        // Step 2: Update existing rows to set a valid service_id (replace 1 with a valid service id)
        DB::table('appointments')->whereNull('service_id')->update(['service_id' => 1]);

        // Step 3: Make the column not nullable and add the foreign key constraint
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable(false)->change();
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
        $table->dropIndex('appointments_service_status_index');
        $table->dropColumn([
            'service_id',
            'status',
            'completed_at',
            'cancelled_at',
            'confirmed_at',
            'pending_at',
        ]);

            //
        });
    }
};
