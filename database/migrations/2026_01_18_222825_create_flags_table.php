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
        Schema::create('flags', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['is_active']);
        });
        Schema::create('flag_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flag_id')->constrained();
            $table->string('locale')->index();
            $table->text('question');
            $table->text('answer');

            $table->softDeletes();

            $table->unique(['flag_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flag_translations');
        Schema::dropIfExists('flags');
    }
};
