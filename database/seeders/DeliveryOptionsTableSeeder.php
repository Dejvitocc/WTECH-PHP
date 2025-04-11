<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryOption;

class DeliveryOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $delivery_options = [
            ['id' => 1, 'name' => 'Packeta', 'price' => 2.99, 'icon_route' => 'images/icons/box-seam.svg'],
            ['id' => 2, 'name' => 'Amazon', 'price' => 3.99, 'icon_route' => 'images/icons/amazon.svg'],
            ['id' => 3, 'name' => 'Pošta', 'price' => 1.99, 'icon_route' => 'images/icons/truck.svg'],
        ];
        
        foreach ($delivery_options as $option) {
            DeliveryOption::updateOrCreate(
                ['id' => $option['id']],
                $option 
            );
        }
        
    }
}
