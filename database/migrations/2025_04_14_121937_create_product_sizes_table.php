<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizesTable extends Migration
{
    public function up()
    {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Cudzí kľúč na products
            $table->foreignId('size_id')->constrained()->onDelete('cascade');    // Cudzí kľúč na sizes
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_sizes');
    }
}
