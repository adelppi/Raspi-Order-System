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
                'title' => 'ラズベリーパイ&コーヒー・セット',
                'description' => 'set',
                'price' => 500,
                'stock' => 50
            ],
            [
                'menu_id' => 2,
                'title' => 'ラズベリーパイ&紅茶・セット',
                'description' => 'set',
                'price' => 500,
                'stock' => 50
            ],
            [
                'menu_id' => 3,
                'title' => 'ラズベリーパイ&緑茶・セット',
                'description' => 'set',
                'price' => 500,
                'stock' => 50
            ],
            [
                'menu_id' => 4,
                'title' => 'ラズベリーパイ&三ツ谷サイダー・セット',
                'description' => 'set',
                'price' => 500,
                'stock' => 50
            ],
            [
                'menu_id' => 5,
                'title' => 'ベビーカステラ',
                'description' => 'food',
                'price' => 100,
                'stock' => 50
            ],
            [
                'menu_id' => 6,
                'title' => '単品・缶コーヒー',
                'description' => 'drink',
                'price' => 200,
                'stock' => 50
            ],
            [
                'menu_id' => 7,
                'title' => '単品・紅茶',
                'description' => 'drink',
                'price' => 200,
                'stock' => 50
            ],
            [
                'menu_id' => 8,
                'title' => '単品・緑茶',
                'description' => 'drink',
                'price' => 200,
                'stock' => 50
            ],
            [
                'menu_id' => 9,
                'title' => '単品・三ツ矢サイダー',
                'description' => 'drink',
                'price' => 200,
                'stock' => 50
            ],
        ]);
    }
}
