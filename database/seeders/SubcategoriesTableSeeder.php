<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $subcategories = [
            ['id' => 1, 'name' => 'Oblečenie'],
            ['id' => 2, 'name' => 'Obuv'],
            ['id' => 3, 'name' => 'Vybavenie'],
            ['id' => 4, 'name' => 'Futbal'],
            ['id' => 5, 'name' => 'Basketbal'],
            ['id' => 6, 'name' => 'Beh'],
            ['id' => 7, 'name' => 'Cyklistika'],
            ['id' => 8, 'name' => 'Plávanie'],
            ['id' => 9, 'name' => 'Tenis'],
        ];

        foreach ($subcategories as $sub) {
            DB::table('subcategories')->updateOrInsert(
                ['id' => $sub['id']],
                $sub
            );
        }
    }
}
