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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('product_name');
            $table->string('tracking-number')->unique();

            $table->text('description')->nullable();

            $table->string('origin');
            $table->string('destination');

            $table->decimal('min_temperature', 5, 2);
            $table->decimal('max_temperature', 5, 2);

            $table->string('status')->default('pending');
            
            $table->dateTime('departure_date')->nullable();
            $table->dateTime('expected_arrival')->nullable();

            $table->string('image_path')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
