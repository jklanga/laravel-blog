<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = date('Y-m-d H:i:s');

        DB::table('comments')->insert([
            'comment' => 'Post comment',
            'post_id' => 1,
            'user_id' => 2,
            'created_at' => $currentDate,
            'updated_at' => $currentDate,
        ]);
    }
}
