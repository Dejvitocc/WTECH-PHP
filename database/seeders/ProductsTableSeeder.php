<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['id' => 1, 'name' => 'Pánske bavlnené tričko', 'description' => 'Pohodlné bavlnené tričko na každodenné nosenie.', 'producerinfo' => 'XYZ Odevy', 'price' => 19.99, 'productinfo' => '100% bavlna, možné prať v práčke', 'stockquantity' => 50],
            ['id' => 2, 'name' => 'Pánske úzke džínsy', 'description' => 'Štýlové úzke džínsy pre pánov.', 'producerinfo' => 'DenimWorks', 'price' => 39.99, 'productinfo' => '98% bavlna, 2% elastan', 'stockquantity' => 30],
            ['id' => 3, 'name' => 'Dámske letné šaty', 'description' => 'Ľahké a vzdušné šaty ideálne na leto.', 'producerinfo' => 'MódnyTrend', 'price' => 49.99, 'productinfo' => 'Polyesterová zmes, čistenie len v čistiarni', 'stockquantity' => 20],
            ['id' => 4, 'name' => 'Detské hračkárske auto', 'description' => 'Zábavné hračkárske auto pre deti od 3 rokov.', 'producerinfo' => 'Hračkárstvo', 'price' => 15.99, 'productinfo' => 'Vyžaduje 2 AA batérie', 'stockquantity' => 100],
            ['id' => 5, 'name' => 'Bežecké topánky', 'description' => 'Výkonné bežecké topánky pre športovcov.', 'producerinfo' => 'ŠportTech', 'price' => 79.99, 'productinfo' => 'Priedušná sieťovina, gumová podrážka', 'stockquantity' => 25],
            ['id' => 6, 'name' => 'Športová fľaša', 'description' => 'Odolná fľaša na vodu pre športové aktivity.', 'producerinfo' => 'HydroVybavenie', 'price' => 9.99, 'productinfo' => 'Plast bez BPA, objem 750ml', 'stockquantity' => 60],
            ['id' => 7, 'name' => 'Baseball rukavica', 'description' => 'Kvalitná rukavica na baseball', 'producerinfo' => 'Wilson', 'price' => 59.99, 'productinfo' => 'Športy', 'stockquantity' => 10],
            ['id' => 8, 'name' => 'Bunda', 'description' => 'Nepremokavá bunda pre mužov', 'producerinfo' => 'North Face', 'price' => 79.99, 'productinfo' => 'Muži', 'stockquantity' => 15],
            ['id' => 9, 'name' => 'Golfová lopta', 'description' => 'Lopta na golf vysokej kvality', 'producerinfo' => 'Titleist', 'price' => 9.99, 'productinfo' => 'Športy', 'stockquantity' => 50],
            ['id' => 10, 'name' => 'Jednoručky', 'description' => 'Sada jednoručiek na cvičenie', 'producerinfo' => 'GymBeam', 'price' => 19.99, 'productinfo' => 'Športy', 'stockquantity' => 20],
            ['id' => 11, 'name' => 'Mikina', 'description' => 'Pohodlná mikina pre mužov', 'producerinfo' => 'Adidas', 'price' => 49.99, 'productinfo' => 'Muži', 'stockquantity' => 25],
            ['id' => 12, 'name' => 'Tenisky', 'description' => 'Štýlové tenisky pre ženy', 'producerinfo' => 'Nike', 'price' => 59.99, 'productinfo' => 'Ženy', 'stockquantity' => 30],
            ['id' => 13, 'name' => 'Basketbalová lopta', 'description' => 'Profesionálna basketbalová lopta', 'producerinfo' => 'Spalding', 'price' => 40.00, 'productinfo' => 'Guma 100%', 'stockquantity' => 15],
            ['id' => 14, 'name' => 'Turistický batoh', 'description' => 'Vodotesný turistický batoh s veľkým úložným priestorom', 'producerinfo' => 'Osprey', 'price' => 49.99, 'productinfo' => 'Polyester 100%', 'stockquantity' => 8],
            ['id' => 15, 'name' => 'Futbalové kopačky', 'description' => 'Profesionálne futbalové kopačky s tretinami', 'producerinfo' => 'Nike', 'price' => 89.99, 'productinfo' => 'Koža 80%, Polyester 20%', 'stockquantity' => 5],
            ['id' => 16, 'name' => 'Kolieskové korčule', 'description' => 'Pohodlné kolieskové korčule pre ženy', 'producerinfo' => 'Rollerblade', 'price' => 59.99, 'productinfo' => 'Plast 60%, Textil 40%', 'stockquantity' => 12],
            ['id' => 17, 'name' => 'Tenisová raketa', 'description' => 'Profesionálna tenisová raketa pre začiatočníkov', 'producerinfo' => 'Wilson', 'price' => 79.99, 'productinfo' => 'Karbon 70%, Grafit 30%', 'stockquantity' => 7],
            ['id' => 18, 'name' => 'Bežecké tenisky', 'description' => 'Odľahčené bežecké tenisky pre ženy', 'producerinfo' => 'Adidas', 'price' => 59.99, 'productinfo' => 'Materiál 100% recyklovaný polyester', 'stockquantity' => 9],
            ['id' => 20, 'name' => 'Fitness kruh', 'description' => 'Pomôcka na posilnenie sedacích svalov', 'producerinfo' => 'Crivit', 'price' => 25.99, 'productinfo' => 'Koža 20%, Plast 80%', 'stockquantity' => 5],
            ['id' => 21, 'name' => 'Cvičiaci blok', 'description' => 'Blok na rôzne fitness cviky a rovnováhu', 'producerinfo' => 'Crivit', 'price' => 10.99, 'productinfo' => 'Polyester 100%', 'stockquantity' => 10],
        ];

        foreach ($products as $product) {
            $createdAt = Carbon::now()->subDays(rand(1, 365));
            $product['created_at'] = $createdAt;
            $product['updated_at'] = $createdAt->addDays(rand(0, 30));

            DB::table('products')->updateOrInsert(['id' => $product['id']], $product);
        }
    }
}
