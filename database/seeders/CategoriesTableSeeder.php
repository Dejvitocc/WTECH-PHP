<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'muzi'],
            ['id' => 2, 'name' => 'zeny'],
            ['id' => 3, 'name' => 'deti'],
            ['id' => 4, 'name' => 'sporty'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['id' => $category['id']], // podmienka
                $category                  // údaje na update alebo insert
            );
        }
    }
}
