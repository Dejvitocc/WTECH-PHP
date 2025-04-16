<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductColorsTable extends Migration
{
    public function up()
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Cudzí kľúč na products
            $table->foreignId('color_id')->constrained()->onDelete('cascade');   // Cudzí kľúč na colors
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_colors');
    }
}
