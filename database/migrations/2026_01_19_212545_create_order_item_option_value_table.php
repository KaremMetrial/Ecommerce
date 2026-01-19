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
        Schema::create('order_item_option_value', function (Blueprint $table) {
            $table->id();
            $table->json('option_data')->nullable();
            $table->json('option_value_data')->nullable();

            $table->timestamps();

            $table->foreignId('order_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('option_id')->constrained()->cascadeOnDelete();
            $table->foreignId('option_value_id')->constrained()->cascadeOnDelete();

            $table->unique(
                ['order_item_id', 'option_id', 'option_value_id'],
                'order_item_option_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_option_value');
    }
};
