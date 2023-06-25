<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
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
        return response()->json(['id'=>$comment->id,'body'=>$comment->body,'user'=>$comment->user,'added_at'=>$comment->created_at->diffForHumans()]);
    }
}
