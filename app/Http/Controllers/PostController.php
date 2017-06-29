<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function show(Post $post, $slug)
    {
        if($post->slug != $slug) {
            return redirect($post->url, 301);// 301 es una redirección permanente
        }
        return view('posts.show', compact('post'));
    }
}
