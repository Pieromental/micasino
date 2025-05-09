<?php

namespace Database\Seeders;

use App\Models\PaymentPlatform;
use Illuminate\Database\Seeder;

class PaymentPlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            ['name' => 'EasyMoney', 'accepts_decimals' => false],
            ['name' => 'SuperWalletz', 'accepts_decimals' => true],
        ];

        foreach ($platforms as $platform) {
            PaymentPlatform::create($platform);
        }
    }
}
