<?php

namespace App\Http\Controllers\Api;

use App\Events\NewComment;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NotifyOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){

    }

    public function store(Request $request){
        $comment = Comment::create([
            'body'=>$request->body,
            'user_id'=>Auth::id(),
            'post_id'=>$request->post_id,
        ]);

        broadcast(new NewComment($comment->user,$comment))->toOthers();
        $post = Post::with('user')->find($comment->post_id);
        $post_owner = $post->user;
        if($post_owner->id != $comment->user_id){
            $post_owner->notify(new NotifyOwner($comment ,  $post));
        }

        return response()->json(['id'=>$comment->id,'body'=>$comment->body,'user'=>$comment->user,'added_at'=>$comment->created_at->diffForHumans()]);
    }
}
