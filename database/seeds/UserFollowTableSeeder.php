<?php

use Illuminate\Database\Seeder;

class UserFollowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now()->format('Y-m-d H:i:s');
        DB::table('user_follow')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'follow_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'follow_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'follow_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'follow_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ]);

    }
}
