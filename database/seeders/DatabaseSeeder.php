<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategoriesTableSeeder::class,
            SubcategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            ColorsTableSeeder::class,
            ProductColorsTableSeeder::class,
            SizesTableSeeder::class,
            ProductSizesTableSeeder::class,
            ImagesTableSeeder::class,
            ProductCategoriesTableSeeder::class,
            DeliveryOptionsTableSeeder::class,
            PaymentMethodsTableSeeder::class,
        ]);
    }
}
//base64:JQuJmQozUfG8BoyefSaKyWMH+OY1jtZu4NzVjdOEKEE=
