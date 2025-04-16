<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSizeColumnFromProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('size');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('size', 255)->nullable();
        });
    }
}
