<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now()->format('Y-m-d H:i:s');
        DB::table('tags')->insert([
            [
                'id' => 1,
                'name' => 'イベント',
                'color' => '#ff9802',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => '店舗情報',
                'color' => '#8bc34a',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'リサイクル',
                'color' => '#e57373',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'ニュース',
                'color' => '#2296f3',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'name' => 'その他',
                'color' => '#9475cc',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
