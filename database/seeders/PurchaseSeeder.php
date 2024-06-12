<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    // /**
    //  * Run the database seeds.
    //  */
    // public function run(): void
    // {
    //     for ($i = 0; $i < 30; $i++) {
    //         DB::table('purchase_requests')->insert([

    //             'item_name' => 'Item ' . ($i + 1),
    //             'quantity' => rand(1, 100),
    //             'description' => 'Description for Item ' . ($i + 1),
    //             'price' => rand(10000, 100000),
    //             'status' => $this->getRandomStatus(),
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }
    // }

    // private function getRandomStatus(): string
    // {
    //     $statuses = ['pending', 'approved', 'rejected'];
    //     return $statuses[array_rand($statuses)];
    // }

    // Daftar kata kunci untuk jenis barang
    private $itemKeywords = [
        'Buku', 'Laptop', 'Smartphone', 'Kamera', 'Headset',
        'Mouse', 'Keyboard', 'Monitor', 'Printer', 'Speaker',
        'Tablet', 'Earphone', 'Jam Tangan', 'Power Bank',
        'Ponsel', 'Televisi', 'Pulpen', 'Papan Tulis', 'Kalkulator'
    ];

    // Daftar kata kunci untuk deskripsi barang
    private $descriptionKeywords = [
        'Barang berkualitas tinggi', 'Merk terkenal', 'Teknologi mutakhir',
        'Desain elegan', 'Spesifikasi canggih', 'Harga terjangkau',
        'Ramah lingkungan', 'Dapat diandalkan', 'Cocok untuk kebutuhan Anda',
        'Meningkatkan produktivitas', 'Mudah digunakan', 'Awet dan tahan lama',
        'Pilihan yang sempurna', 'Inovatif dan kreatif', 'Desain ergonomis'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            DB::table('purchase_requests')->insert([
                'item_name' => $this->generateItemName(),
                'quantity' => rand(1, 100),
                'description' => $this->generateDescription(),
                'price' => rand(10000, 100000),
                'status' => $this->getRandomStatus(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Fungsi untuk menghasilkan nama barang secara acak
    private function generateItemName(): string
    {
        $keyword1 = Arr::random($this->itemKeywords);
        $keyword2 = Arr::random($this->itemKeywords);
        return "{$keyword1} {$keyword2}";
    }

    // Fungsi untuk menghasilkan deskripsi barang secara acak
    private function generateDescription(): string
    {
        $keyword = Arr::random($this->descriptionKeywords);
        return "{$keyword}";
    }

    // Fungsi untuk mendapatkan status secara acak
    private function getRandomStatus(): string
    {
        $statuses = ['pending', 'approved', 'rejected'];
        return $statuses[array_rand($statuses)];
    }
}
