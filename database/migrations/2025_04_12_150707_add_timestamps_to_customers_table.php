<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->timestamps(); // Pridá created_at a updated_at
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropTimestamps(); // Odstráni created_at a updated_at
        });
    }
}
