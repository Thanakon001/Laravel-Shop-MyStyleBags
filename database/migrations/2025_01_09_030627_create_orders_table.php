<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_id', 20)->primary();
            $table->dateTime('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('id');
            $table->string('order_name');
            $table->string('order_address');
            $table->string('order_phone', 10);
            $table->string('order_payment');
            $table->string('order_details')->nullable();
            $table->decimal('order_total', 10, 2)->default(0);
            $table->string('order_status')->default('รอยืนยันชำระ');
            $table->string('order_tracking')->default('ไม่มี');
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
