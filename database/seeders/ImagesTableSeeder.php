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

            ['id' => 15, 'text' => null,                         'route' => 'images/panske_tricko.jpg',          'productid' => 1],
            ['id' => 16, 'text' => null,                         'route' => 'images/panske_tricko2.jpg',          'productid' => 1],
            ['id' => 17, 'text' => null,                         'route' => 'images/dzinsy.jpg',          'productid' => 2],
            ['id' => 18, 'text' => null,                         'route' => 'images/dzinsy2.jpg',          'productid' => 2],
            ['id' => 19, 'text' => null,                         'route' => 'images/saty.jpg',          'productid' => 3],
            ['id' => 20, 'text' => null,                         'route' => 'images/saty2.jpg',          'productid' => 3],
            ['id' => 21, 'text' => null,                         'route' => 'images/auto.jpg',          'productid' => 4],
            ['id' => 22, 'text' => null,                         'route' => 'images/auto2.jpg',          'productid' => 4],
            ['id' => 23, 'text' => null,                         'route' => 'images/bezecke_topanky.jpg',          'productid' => 5],
            ['id' => 24, 'text' => null,                         'route' => 'images/bezecke_topanky2.jpg',          'productid' => 5],
            ['id' => 25, 'text' => null,                         'route' => 'images/flasa.jpg',          'productid' => 6],
            ['id' => 26, 'text' => null,                         'route' => 'images/flasa2.jpg',          'productid' => 6],
            ['id' => 27, 'text' => null,                         'route' => 'images/baseball_rukavica2.jpg',          'productid' => 7],
            ['id' => 28, 'text' => null,                         'route' => 'images/bunda2.jpg',          'productid' => 8],
            ['id' => 29, 'text' => null,                         'route' => 'images/golfova_lopta2.jpg',          'productid' => 9],
            ['id' => 30, 'text' => null,                         'route' => 'images/jednorucky2.jpg',          'productid' => 10],
            ['id' => 31, 'text' => null,                         'route' => 'images/mikina2.jpg',          'productid' => 11],
            ['id' => 32, 'text' => null,                         'route' => 'images/tenisky2.jpg',          'productid' => 12],
            ['id' => 33, 'text' => null,                         'route' => 'images/basketbalova_lopta2.jpg',          'productid' => 13],
            ['id' => 34, 'text' => null,                         'route' => 'images/batoh2.jpg',          'productid' => 14],
            ['id' => 35, 'text' => null,                         'route' => 'images/futbalove_kopacky2.jpg',          'productid' => 15],
            ['id' => 36, 'text' => null,                         'route' => 'images/korcule2.jpg',          'productid' => 16],
            ['id' => 37, 'text' => null,                         'route' => 'images/tenisova_raketa2.jpg',          'productid' => 17],
            ['id' => 38, 'text' => null,                         'route' => 'images/bezecke_tenisky.jpg',          'productid' => 18],
            ['id' => 39, 'text' => null,                         'route' => 'images/fitness_kruh2.jpg',          'productid' => 20],
            ['id' => 40, 'text' => null,                         'route' => 'images/cviciaci_blok2.jpg',          'productid' => 21],
        ];

        foreach ($images as $img) {
            DB::table('images')->updateOrInsert(
                ['id' => $img['id']],
                $img
            );
        }
    }
}
