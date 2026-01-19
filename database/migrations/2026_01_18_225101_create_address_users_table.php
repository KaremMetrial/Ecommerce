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
        Schema::create('address_users', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('city');
            $table->string('zip')->nullable();
            $table->timestamps();

            $table->foreignId('city_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->index(['city', 'zip']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_users');
    }
};
