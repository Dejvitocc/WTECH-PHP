<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ColorsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Zoznam unikátnych farieb (zhromaždený z pôvodných dát produktov)
        $colors = [
            'blue',
            'white',
            'black',
            'grey',
            'yellow',
            'red',
            'pink',
            'orange',
            'green',
            'brown',
        ];

        foreach ($colors as $color) {
            $createdAt = Carbon::now()->subDays(rand(1, 365));
            DB::table('colors')->updateOrInsert(
                ['name' => $color],
                [
                    'name' => $color,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt->addDays(rand(0, 30)),
                ]
            );
        }
    }
}
