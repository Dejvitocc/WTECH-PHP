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
        Schema::create('shopping_cart', function (Blueprint $table) {
            $table->id(); // Štandardný primárny kľúč
            $table->unsignedBigInteger('customer_id')->nullable(); // Cudzí kľúč pre používateľa
            $table->unsignedBigInteger('product_id'); // Cudzí kľúč pre produkt
            $table->integer('quantity')->default(1);
            $table->string('color')->nullable(); // Nový stĺpec pre farbu
            $table->string('size')->nullable();  // Nový stĺpec pre veľkosť

            // Definícia cudzích kľúčov
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');

            // Unikátny index na kombináciu customer_id, product_id, color, size
            $table->unique(['customer_id', 'product_id', 'color', 'size'], 'shopping_cart_unique_combo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart');
    }
};
