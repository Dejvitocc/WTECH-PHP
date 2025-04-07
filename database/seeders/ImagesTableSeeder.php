<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            ['id' => 1,  'text' => 'Rukavica na baseball',     'route' => 'images/baseball_rukavica.jpg',       'productid' => 7],
            ['id' => 2,  'text' => 'Nepremokavá bunda',         'route' => 'images/bunda.jpg',                   'productid' => 8],
            ['id' => 3,  'text' => 'Lopta na golf',              'route' => 'images/golfova_lopta.jpg',           'productid' => 9],
            ['id' => 4,  'text' => 'Kovové jednoručky',          'route' => 'images/jednorucky.jpg',              'productid' => 10],
            ['id' => 5,  'text' => 'Bavlnená mikina',            'route' => 'images/mikina.png',                  'productid' => 11],
            ['id' => 6,  'text' => 'Outdoor tenisky',            'route' => 'images/teniska2.jpg',                'productid' => 12],
            ['id' => 7,  'text' => 'Lopta na basketball',        'route' => 'images/basketbalova_lopta.jpg',      'productid' => 13],
            ['id' => 8,  'text' => null,                         'route' => 'images/batoh.jpg',                   'productid' => 14],
            ['id' => 9,  'text' => null,                         'route' => 'images/futbalove_kopacky.jpg',       'productid' => 15],
            ['id' => 10, 'text' => null,                         'route' => 'images/korcule.jpg',                 'productid' => 16],
            ['id' => 11, 'text' => null,                         'route' => 'images/tenisova_raketa.jpg',         'productid' => 17],
            ['id' => 12, 'text' => null,                         'route' => 'images/teniska1.jpg',                'productid' => 18],
            ['id' => 13, 'text' => null,                         'route' => 'images/fitness_kruh.jpeg',           'productid' => 20],
            ['id' => 14, 'text' => null,                         'route' => 'images/cviciaci_blok.jpeg',          'productid' => 21],
        ];

        foreach ($images as $img) {
            DB::table('images')->updateOrInsert(
                ['id' => $img['id']],
                $img
            );
        }
    }
}
