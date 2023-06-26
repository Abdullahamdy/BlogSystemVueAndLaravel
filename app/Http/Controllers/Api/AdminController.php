<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use GuzzleHttp\Middleware;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    public function getCategories(){
      $categories =   Category::get();
      return response()->json($categories);
    }

    public function addPost(Request $request){
        $filename = '';
       if($request->hasFile('image')){
          $filename = time().'.'.$request->image->getClientOriginalExtension();
          $request->image->move(public_path('img'),$filename);
       }
       $post = Post::create([
           'title'=>$request->title,
           'slug'=>Str::slug($request->title),
           'body'=>$request->body,
           'category_id'=>$request->category,
           'user_id'=>Auth::id(),
           'image'=>$filename,
       ]);
       return response()->json($post);
   }
}
