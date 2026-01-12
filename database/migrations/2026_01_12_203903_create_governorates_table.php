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
        Schema::create('governorates', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_active']);

            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
        });
        Schema::create('governorate_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('governorate_id')->constrained();
            $table->string('locale')->index();
            $table->string('name');

            $table->softDeletes();

            $table->unique(['governorate_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governorates');
        Schema::dropIfExists('governorate_translations');
    }
};
