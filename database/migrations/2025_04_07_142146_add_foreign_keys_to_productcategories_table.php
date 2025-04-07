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
        Schema::table('productcategories', function (Blueprint $table) {
            $table->foreign(['categoryid'], 'productcategories_categoryid_fkey')->references(['id'])->on('categories')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['productid'], 'productcategories_productid_fkey')->references(['id'])->on('products')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['subcategoryid'], 'productcategories_subcategoryid_fkey')->references(['id'])->on('subcategories')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productcategories', function (Blueprint $table) {
            $table->dropForeign('productcategories_categoryid_fkey');
            $table->dropForeign('productcategories_productid_fkey');
            $table->dropForeign('productcategories_subcategoryid_fkey');
        });
    }
};
