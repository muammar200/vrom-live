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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->foreignId('type_id')->constrained(); 
            $table->foreignId('brand_id')->constrained();

            $table->text('photos')->nullable();
            $table->text('features')->nullable();

            $table->decimal('price', $precision = 20, $scale = 2)->default(0);
            $table->decimal('star', $precision = 1, $scale = 1)->default(0);
            $table->integer('review')->default(0);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
