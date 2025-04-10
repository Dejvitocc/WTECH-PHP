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
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text')->nullable();
            $table->string('route');
            $table->integer('productid');

            // Definícia cudzieho kľúča
            $table->foreign('productid')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade'); // Kaskádové vymazanie
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
