<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // published scope'u kullanıyoruz
        $posts = Post::published()->latest()->get();

        return view('posts.index', compact('posts'));
    }

    // /posts/{post:slug} → tekil yazı
    public function show(Post $post)
    {
        // Bu noktada DraftAccess middleware zaten taslak kontrolünü yaptı
        return view('posts.show', compact('post'));
    }
}
