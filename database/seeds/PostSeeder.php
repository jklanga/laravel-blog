<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = date('Y-m-d H:i:s');

        DB::table('posts')->insert([
            'title' => 'Post Title',
            'content' => 'This is the post content',
            'user_id' => 1,
            'created_at' => $currentDate,
            'updated_at' => $currentDate,
        ]);

    }
}
