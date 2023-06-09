<?php
namespace Database\Seeders;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         Comment::create([
            'body'=>'some comment here from a simple user',
            'user_id'=>1,
            'post_id'=>1,
        ]);
        Comment::create([
            'body'=>'some comment here from a simple user',
            'user_id'=>1,
            'post_id'=>2,
        ]);
        Comment::create([
            'body'=>'some comment here from a simple user',
            'user_id'=>1,
            'post_id'=>3,
        ]);
    }
}
