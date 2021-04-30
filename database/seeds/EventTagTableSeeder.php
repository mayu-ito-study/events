<?php

use Illuminate\Database\Seeder;

class EventTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now()->format('Y-m-d H:i:s');
        DB::table('event_tag')->insert([
            [
                'id' => 1,
                'event_id' => 1,
                'tag_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'event_id' => 2,
                'tag_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'event_id' => 3,
                'tag_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'event_id' => 3,
                'tag_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
