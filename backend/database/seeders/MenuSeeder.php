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
                'title' => 'ラズベリーパイ&コーヒー',
                'description' => 'set',
                'price' => 600,
                'stock' => 50
            ],
            [
                'menu_id' => 2,
                'title' => 'ラズベリーパイ&紅茶',
                'description' => 'set',
                'price' => 600,
                'stock' => 50
            ],
            [
                'menu_id' => 3,
                'title' => 'ラズベリーパイ&緑茶',
                'description' => 'set',
                'price' => 600,
                'stock' => 50
            ],
            [
                'menu_id' => 4,
                'title' => 'ラズベリーパイ&三ツ矢サイダー',
                'description' => 'set',
                'price' => 600,
                'stock' => 50
            ],
            [
                'menu_id' => 5,
                'title' => 'ラズベリーパイ&コーラ',
                'description' => 'set',
                'price' => 600,
                'stock' => 50
            ],
            [
                'menu_id' => 6,
                'title' => 'ベビーカステラ',
                'description' => 'food',
                'price' => 200,
                'stock' => 50
            ],
            [
                'menu_id' => 7,
                'title' => 'ジャム・いちご',
                'description' => 'jam',
                'price' => 0,
                'stock' => 50
            ],
            [
                'menu_id' => 8,
                'title' => 'ジャム・ブルーベリー',
                'description' => 'jam',
                'price' => 0,
                'stock' => 50
            ],
            [
                'menu_id' => 9,
                'title' => 'ジャム・マーマレード',
                'description' => 'jam',
                'price' => 0,
                'stock' => 50
            ],
            [
                'menu_id' => 10,
                'title' => '単品・缶コーヒー',
                'description' => 'drink',
                'price' => 200,
                'stock' => 50
            ],
            [
                'menu_id' => 11,
                'title' => '単品・紅茶',
                'description' => 'drink',
                'price' => 200,
                'stock' => 50
            ],
            [
                'menu_id' => 12,
                'title' => '単品・緑茶',
                'description' => 'drink',
                'price' => 200,
                'stock' => 50
            ],
            [
                'menu_id' => 13,
                'title' => '単品・三ツ矢サイダー',
                'description' => 'drink',
                'price' => 200,
                'stock' => 50
            ],
            [
                'menu_id' => 14,
                'title' => 'コーラ',
                'description' => 'drink',
                'price' => 200,
                'stock' => 50
            ],
        ]);
    }
}
