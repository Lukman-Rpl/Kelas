<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'name' => 'Ayam Goreng Sambal Spesial',
                'description' => 'Ayam goreng dengan sambal spesial yang pedas dan nikmat.',
                'price' => 25000,
                'image' => 'ayam1.jpeg'
            ],
            [
                'name' => 'Ayam Goreng Special',
                'description' => 'Ayam goreng dengan bumbu spesial dan gurih.',
                'price' => 22000,
                'image' => 'ayam2.jpeg'
            ],
            [
                'name' => 'Ayam Goreng Pedas',
                'description' => 'Ayam goreng dengan sambal pedas yang menggugah selera.',
                'price' => 23000,
                'image' => 'ayam3.jpeg'
            ]
        ]);
    }
}
