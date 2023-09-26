<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'menu_id' => 1,
                'title' => 'ラズベリーパイ',
                'description' => 'おいしいラズパイです。',
                'price' => 300,
                'stock' => 100
            ],
            [
                'menu_id' => 2,
                'title' => 'クッキー',
                'description' => 'おいしいクッキーです。',
                'price' => 200,
                'stock' => 100
            ],
            [
                'menu_id' => 3,
                'title' => 'ジュース',
                'description' => 'おいしいジュースです。',
                'price' => 150,
                'stock' => 100
            ]
        ]);
    }
}
