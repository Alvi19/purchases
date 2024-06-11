<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            DB::table('purchase_requests')->insert([

                'item_name' => 'Item ' . ($i + 1),
                'quantity' => rand(1, 100),
                'description' => 'Description for Item ' . ($i + 1),
                'price' => rand(10000, 100000),
                'status' => $this->getRandomStatus(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function getRandomStatus(): string
    {
        $statuses = ['pending', 'approved', 'rejected'];
        return $statuses[array_rand($statuses)];
    }
}
