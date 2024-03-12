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
        Schema::create('bookings', function (Blueprint $table) {
            // PK
            $table->id();

            // Relation To Item and User
            $table->foreignId('item_id')->constrained();
            $table->foreignId('user_id')->constrained();

            // Name
            $table->string('name')->nullable();

            // Start and end date
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Address
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();

            // Status
            $table->string('status')->default('pending');

            // Payment Status
            $table->string('payment_method')->default('midtrans');
            $table->string('payment_status')->default('pending');
            $table->string('payment_url')->nullable();

            // Total Price
            $table->decimal('total_price', $precision = 20, $scale = 2)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
