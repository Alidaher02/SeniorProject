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
        Schema::create('shipment_analyses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shipment_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('summary')->nullable();

            $table->unsignedTinyInteger('risk_percentage')->nullable();
            $table->string('risk_level')->nullable();

            $table->unsignedInteger('critical_count')->default(0);
            $table->unsignedInteger('warning_count')->default(0);

            $table->json('critical')->nullable();
            $table->json('warnings')->nullable();
            $table->json('recommendations')->nullable();

            $table->timestamp('analyzed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_analyses');
    }
};
