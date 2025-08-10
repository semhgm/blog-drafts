<?php

// app/Http/Controllers/PostAdminController.php
namespace App\Http\Controllers;

use App\Models\Post;

class PostAdminController extends Controller
{
    public function index()
    {
        // Taslaklar ve yayınlanmışlar basitçe
        $drafts = Post::with('user')->where('is_draft', true)->latest()->paginate(10, ['*'], 'd');
        $published = Post::with('user')->where('is_draft', false)->latest()->paginate(10, ['*'], 'p');

        return view('admin.posts.index', compact('drafts','published'));
    }

    public function publish(Post $post)
    {
        $post->update(['is_draft' => false]);
        return back()->with('status', 'Yazı yayınlandı.');
    }

    public function draft(Post $post)
    {
        $post->update(['is_draft' => true]);
        return back()->with('status', 'Yazı taslağa alındı.');
    }
}

