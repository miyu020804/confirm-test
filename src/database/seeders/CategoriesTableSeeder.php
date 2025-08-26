<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('categories')->upsert(
            [
                ['id' => 1, 'content' => '商品のお届けについて', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['id' => 2, 'content' => '商品の交換について', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['id' => 3, 'content' => '商品トラブル', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['id' => 4, 'content' => 'ショップへのお問い合わせ', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['id' => 5, 'content' => 'その他', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ],
            ['id'],
            ['content', 'updated_at']
        );
    }
}
