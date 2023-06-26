<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
       $this->middleware('isAdmin');

    }
    public function getPosts(){
        $posts = Post::latest()->with('user')->with('Category')->paginate(5);
        return response()->json($posts);
    }
}
