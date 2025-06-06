<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColorColumnFromProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('color', 255)->nullable();
        });
    }
}
