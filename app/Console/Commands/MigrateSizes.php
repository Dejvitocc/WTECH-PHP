<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Size;

class MigrateSizes extends Command
{
    protected $signature = 'migrate:sizes';
    protected $description = 'Migrate sizes from products.size to sizes and product_sizes tables';

    public function handle()
    {
        $this->info('Starting size migration...');

        $products = Product::all();

        foreach ($products as $product) {
            if (empty($product->size)) {
                continue;
            }

            $sizeNames = array_map('trim', explode(',', $product->size));

            foreach ($sizeNames as $sizeName) {
                $size = Size::firstOrCreate(['name' => $sizeName]);
                $product->sizes()->syncWithoutDetaching($size->id);
            }
        }

        $this->info('Size migration completed successfully!');
    }
}
