<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductColorsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Produkt a jeho farby (zhromaždené z pôvodných dát)
        $productColors = [
            1 => ['blue', 'white', 'black'], // Pánske bavlnené tričko
            2 => ['blue', 'black', 'grey'],  // Pánske úzke džínsy
            3 => ['yellow', 'red', 'pink'],  // Dámske letné šaty
            4 => ['red', 'blue'],            // Detské hračkárske auto
            5 => ['blue', 'orange'],         // Bežecké topánky
            6 => ['green', 'black'],         // Športová fľaša
            7 => ['brown'],                  // Baseball rukavica
            8 => ['black', 'grey'],          // Bunda
            9 => ['white', 'yellow'],        // Golfová lopta
            10 => ['black'],                 // Jednoručky
            11 => ['blue', 'red', 'green'],  // Mikina
            12 => ['green', 'pink'],         // Tenisky
            13 => ['orange'],                // Basketbalová lopta
            14 => ['blue', 'red'],           // Turistický batoh
            15 => ['yellow', 'black'],       // Futbalové kopačky
            16 => ['black'],                 // Kolieskové korčule
            17 => ['grey', 'black'],         // Tenisová raketa
            18 => ['pink', 'orange'],        // Bežecké tenisky
            20 => ['black'],                 // Fitness kruh
            21 => ['blue', 'red', 'green'],  // Cvičiaci blok
        ];

        foreach ($productColors as $productId => $colors) {
            foreach ($colors as $colorName) {
                // Nájdeme ID farby
                $color = DB::table('colors')->where('name', $colorName)->first();
                if (!$color) {
                    continue; // Ak farba neexistuje, preskočíme
                }

                $createdAt = Carbon::now()->subDays(rand(1, 365));
                DB::table('product_colors')->updateOrInsert(
                    ['product_id' => $productId, 'color_id' => $color->id],
                    [
                        'product_id' => $productId,
                        'color_id' => $color->id,
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt->addDays(rand(0, 30)),
                    ]
                );
            }
        }
    }
}
