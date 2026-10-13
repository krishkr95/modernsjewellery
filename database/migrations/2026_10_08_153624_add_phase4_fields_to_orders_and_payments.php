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
        Schema::table('orders', function (Blueprint $table) {
            // Modify status column to varchar to support all 10 order states requested
            $table->string('status', 50)->default('PAYMENT_PENDING')->change();
            $table->string('razorpay_order_id')->nullable()->index()->after('order_number');
            $table->string('razorpay_payment_id')->nullable()->index()->after('razorpay_order_id');
            $table->string('razorpay_signature')->nullable()->after('razorpay_payment_id');
            $table->string('pincode', 10)->nullable()->index()->after('customer_phone');
            $table->timestamp('expected_delivery_at')->nullable()->after('delivered_at');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_method', 50)->default('razorpay')->change();
            $table->string('gateway_order_id')->nullable()->index()->after('gateway_transaction_id');
            $table->string('gateway_signature')->nullable()->after('gateway_order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['gateway_order_id', 'gateway_signature']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'razorpay_order_id',
                'razorpay_payment_id',
                'razorpay_signature',
                'pincode',
                'expected_delivery_at',
            ]);
        });
    }
};
