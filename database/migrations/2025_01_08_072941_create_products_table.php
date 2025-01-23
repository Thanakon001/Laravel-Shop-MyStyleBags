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
            $table->string('pro_bacode',40)->primary();
            $table->string('pro_name');
            $table->string('band_id');
            $table->string('pro_details')->nullable();
            $table->decimal('pro_price', 10, 2)->default(0);
            $table->integer('pro_stock')->default(0);
            $table->timestamps();
        });
        
        DB::statement('ALTER TABLE products ADD COLUMN pro_image MEDIUMBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
