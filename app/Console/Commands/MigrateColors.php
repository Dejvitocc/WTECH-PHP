<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Color;

class MigrateColors extends Command
{
    protected $signature = 'migrate:colors';
    protected $description = 'Migrate colors from products.color to colors and product_colors tables';

    public function handle()
    {
        $this->info('Starting color migration...');

        // Načítame všetky produkty
        $products = Product::all();

        foreach ($products as $product) {
            // Ak produkt nemá farbu, pokračujeme na ďalší
            if (empty($product->color)) {
                continue;
            }

            // Rozdelíme farby podľa čiarky a odstránime medzery
            $colorNames = array_map('trim', explode(',', $product->color));

            foreach ($colorNames as $colorName) {
                // Vytvoríme alebo získame farbu
                $color = Color::firstOrCreate(['name' => strtolower($colorName)]);

                // Pripojíme farbu k produktu
                $product->colors()->syncWithoutDetaching($color->id);
            }
        }

        $this->info('Color migration completed successfully!');
    }
}
