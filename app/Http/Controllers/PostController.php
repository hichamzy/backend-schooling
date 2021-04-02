<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => "required",
            'body' => "required",
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => "required",
            'body' => "required",
        ]);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();
    }
}
