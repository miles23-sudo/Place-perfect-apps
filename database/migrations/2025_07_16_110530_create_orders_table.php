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

            $table->dateTime('pay_at')->nullable();
            $table->dateTime('ship_at')->nullable();
            $table->dateTime('receive_at')->nullable();
            $table->dateTime('decline_at')->nullable();

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
