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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Tạo cột id với kiểu dữ liệu bigint auto-increment và làm khóa chính
            $table->text("Order_Describe")->nullable();
            $table->integer("customer_id");
            $table->decimal("TotalAmount");
            $table->enum('PaymentMethod', ['Credit Card', 'PayPal', 'Cash', 'Bank Transfer']);
            $table->enum('PaymentStatus', ['Completed', 'Failed', 'Transporting', 'Verify']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
