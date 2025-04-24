<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'email' => 'admin@admin.sk',
            'name' => 'Admin',
            'surname' => '2',
            'password' => Hash::make('hesloheslo'),
            'privacy_consent' => true,
            'phone_number' => null,
            'street' => null,
            'home_number' => null,
            'postal_code' => null,
            'city' => null,
            'country' => null,
        ]);
    }
}
