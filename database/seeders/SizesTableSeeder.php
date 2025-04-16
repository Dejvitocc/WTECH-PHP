<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SizesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Zoznam unikátnych veľkostí (zhromaždený z pôvodných dát produktov)
        $sizes = [
            'XS',
            'S',
            'M',
            'L',
            'XL',
            '32',
            '33',
            '34',
            '36',
            '37',
            '38',
            '39',
            '42',
            '43',
            '44',
            '45',
            'Uni',
        ];

        foreach ($sizes as $size) {
            $createdAt = Carbon::now()->subDays(rand(1, 365));
            DB::table('sizes')->updateOrInsert(
                ['name' => $size],
                [
                    'name' => $size,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt->addDays(rand(0, 30)),
                ]
            );
        }
    }
}
