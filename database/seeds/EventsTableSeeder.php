<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now()->format('Y-m-d H:i:s');
        DB::table('events')->insert([
            [
                'user_id' => 1,
                'title' => 'test title 1',
                'content' => 'test content 1',
                'image' => 'myprefix/O3RmqnxQY0UzIfP1pQ2Q9iKllAitSkbE6qAFR8gk.jpg',
                'date' => '2021-04-01 00:00:00',
                'place' => 'test place 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'title' => 'test title 2',
                'content' => 'test content 2',
                'image' => 'myprefix/m79iCop21Kniyw1t0IA0njyQD3slhpzDz4UVfv0s.jpg',
                'date' => '2021-05-01 00:00:00',
                'place' => 'test place 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 3,
                'title' => 'test title 3',
                'content' => 'test content 3',
                'image' => 'myprefix/3EbV8w6Gq93TfVcl5mec2dh74FmgVWOfek0UJi2o.jpg',
                'date' => '2021-05-10 00:00:00',
                'place' => 'test place 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
