<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Product;
use App\Models\CustomerAddress;
use App\Models\Customer;
use App\Enums\OrderStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnDelete();

            $table->uuid('order_number')->unique();
            $table->longText('checkout_session_id')->nullable();

            $table->longText('shipping_address')->nullable();
            $table->decimal('overall_total', 10, 2)->default(0.00);
            $table->longText('additional_notes')->nullable();

            $table->dateTime('paid_at')->nullable();

            $table->enum('status', array_column(OrderStatus::cases(), 'value'))->default(OrderStatus::AwaitingPayment->value);
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
