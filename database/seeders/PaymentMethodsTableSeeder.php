<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_methods = [
            ['id' => 1, 'name' => 'Visa',  'icon_route' => 'images/icons/credit-card.svg'],
            ['id' => 2, 'name' => 'Mastercard',  'icon_route' => 'images/icons/wallet.svg'],
            ['id' => 3, 'name' => 'PayPal',  'icon_route' => 'images/icons/cash.svg'],
        ];

        foreach ($payment_methods as $method) {
            PaymentMethod::updateOrCreate(
                ['id' => $method['id']],
                $method
            );
        }
    }
}
