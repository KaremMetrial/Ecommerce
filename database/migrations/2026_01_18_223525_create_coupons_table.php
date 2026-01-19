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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('discount')->default(0);
            $table->string('discount_type')->default(\App\Enums\DiscountTypeEnum::FIXED);
            $table->date('expire_at');
            $table->unsignedBigInteger('limit')->default(1);
            $table->unsignedBigInteger('times_used')->default(0);
            $table->unsignedBigInteger('min_order_amount')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            $table->index(['is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
