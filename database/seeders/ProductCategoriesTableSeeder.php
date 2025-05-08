<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $productCategories = [
            ['productid' => 1, 'categoryid' => 1, 'subcategoryid' => 1],
            ['productid' => 2, 'categoryid' => 1, 'subcategoryid' => 1],
            ['productid' => 3, 'categoryid' => 2, 'subcategoryid' => 1],
            ['productid' => 4, 'categoryid' => 3, 'subcategoryid' => 3],
            ['productid' => 5, 'categoryid' => 4, 'subcategoryid' => 6],
            ['productid' => 6, 'categoryid' => 4, 'subcategoryid' => 3],
            ['productid' => 7, 'categoryid' => 4, 'subcategoryid' => 3],
            ['productid' => 8, 'categoryid' => 1, 'subcategoryid' => 1],
            ['productid' => 9, 'categoryid' => 4, 'subcategoryid' => 3],
            ['productid' => 10, 'categoryid' => 4, 'subcategoryid' => 3],
            ['productid' => 11, 'categoryid' => 1, 'subcategoryid' => 1],
            ['productid' => 12, 'categoryid' => 2, 'subcategoryid' => 2],
            ['productid' => 13, 'categoryid' => 4, 'subcategoryid' => 5],
            ['productid' => 14, 'categoryid' => 4, 'subcategoryid' => 7],
            ['productid' => 15, 'categoryid' => 4, 'subcategoryid' => 4],
            ['productid' => 16, 'categoryid' => 4, 'subcategoryid' => 3],
            ['productid' => 17, 'categoryid' => 4, 'subcategoryid' => 9],
            ['productid' => 18, 'categoryid' => 4, 'subcategoryid' => 6],
            ['productid' => 20, 'categoryid' => 4, 'subcategoryid' => 3],
            ['productid' => 21, 'categoryid' => 4, 'subcategoryid' => 3],
        ];

        foreach ($productCategories as $productCategory) {
            DB::table('productcategories')->updateOrInsert(
                ['productid' => $productCategory['productid'], 'categoryid' => $productCategory['categoryid'], 'subcategoryid' => $productCategory['subcategoryid']],
                $productCategory
            );
        }
    }
}
