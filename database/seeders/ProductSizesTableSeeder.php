<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSizesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Produkt a jeho veľkosti (zhromaždené z pôvodných dát)
        $productSizes = [
            1 => ['M', 'L', 'XL'],         // Pánske bavlnené tričko
            2 => ['32', '33', '34'],       // Pánske úzke džínsy
            3 => ['XS', 'S', 'M'],         // Dámske letné šaty
            4 => ['Uni'],                  // Detské hračkárske auto
            5 => ['42', '43', '44', '45'], // Bežecké topánky
            6 => ['Uni'],                  // Športová fľaša
            7 => ['M', 'L'],               // Baseball rukavica
            8 => ['L', 'XL'],              // Bunda
            9 => ['Uni'],                  // Golfová lopta
            10 => ['Uni'],                 // Jednoručky
            11 => ['Uni'],                 // Mikina
            12 => ['36', '37', '38'],      // Tenisky
            13 => ['Uni'],                 // Basketbalová lopta
            14 => ['Uni'],                 // Turistický batoh
            15 => ['42', '43', '44'],      // Futbalové kopačky
            16 => ['37', '38'],            // Kolieskové korčule
            17 => ['Uni'],                 // Tenisová raketa
            18 => ['37', '38', '39'],      // Bežecké tenisky
            20 => ['Uni'],                 // Fitness kruh
            21 => ['Uni'],                 // Cvičiaci blok
        ];

        foreach ($productSizes as $productId => $sizes) {
            foreach ($sizes as $sizeName) {
                $size = DB::table('sizes')->where('name', $sizeName)->first();
                if (!$size) {
                    continue;
                }

                $createdAt = Carbon::now()->subDays(rand(1, 365));
                DB::table('product_sizes')->updateOrInsert(
                    ['product_id' => $productId, 'size_id' => $size->id],
                    [
                        'product_id' => $productId,
                        'size_id' => $size->id,
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt->addDays(rand(0, 30)),
                    ]
                );
            }
        }
    }
}
