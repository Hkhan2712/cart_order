<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('brand')->nullable();
            $table->string('expiry')->nullable();
            $table->string('weight_detail')->nullable(); // ví dụ: "500g"
            $table->string('packaging_type')->nullable();
            $table->string('warranty_period')->nullable(); // ví dụ: "3 năm"
            $table->string('registration_number')->nullable(); // số lưu hành
            $table->string('serial_number')->nullable();
            $table->string('manufacturer_name')->nullable();
            $table->string('shipped_from')->nullable(); // ví dụ: "TP. Hồ Chí Minh"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
