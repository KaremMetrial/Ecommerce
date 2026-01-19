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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');

            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('quantity')->default(0);
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('discount')->default(0);

            $table->string('discount_type')->default(\App\Enums\DiscountTypeEnum::FIXED);

            $table->date('available_for')->nullable();
            $table->date('discount_start_date')->nullable();
            $table->date('discount_end_date')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('is_auto_manage_stock')->default(true);
            $table->boolean('is_available_in_stock')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('currency_id')->constrained()->cascadeOnDelete();

            $table->unique(['sku']);
            $table->index(['is_active', 'available_for', 'category_id', 'brand_id', 'currency_id']);
        });
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('locale')->index();
            $table->string('name');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->softDeletes();

            $table->unique(['product_id', 'locale', 'slug', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_translations');
    }
};
