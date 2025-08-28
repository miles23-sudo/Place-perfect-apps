<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Customer;
use App\Enums\OrderStatus;
use App\Enums\OrderPaymentMode;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnDelete();

            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->decimal('overall_total', 10, 2)->storedAs('subtotal + shipping_fee');

            $table->enum('payment_mode', array_column(OrderPaymentMode::cases(), 'value'))->default(OrderPaymentMode::COD->value);
            $table->string('payment_channel')->nullable();
            $table->longText('payment_proof')->nullable();
            $table->enum('status', array_column(OrderStatus::cases(), 'value'))->default(OrderStatus::ToPay->value);

            $table->longText('return_photos')->nullable();
            $table->longText('return_reason')->nullable();

            $table->dateTime('to_pay_at')->nullable();
            $table->dateTime('to_ship_at')->nullable();
            $table->dateTime('to_receive_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->dateTime('declined_at')->nullable();
            $table->dateTime('return_refund_at')->nullable();
            $table->dateTime('return_refund_completed_at')->nullable();
            $table->dateTime('return_refund_declined_at')->nullable();

            $table->longText('additional_notes')->nullable();
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
