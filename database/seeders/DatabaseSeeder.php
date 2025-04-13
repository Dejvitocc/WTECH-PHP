<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategoriesTableSeeder::class,
            SubcategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            ImagesTableSeeder::class,
            ProductCategoriesTableSeeder::class,
            DeliveryOptionsTableSeeder::class,
            PaymentMethodsTableSeeder::class,
        ]);
    }
}
//base64:JQuJmQozUfG8BoyefSaKyWMH+OY1jtZu4NzVjdOEKEE=
