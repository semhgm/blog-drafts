<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        // published scope'u kullanıyoruz
        $posts = Post::with('user')->published()->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    // /posts/{post:slug} → tekil yazı
    public function show(Post $post)
    {
        // Bu noktada DraftAccess middleware zaten taslak kontrolünü yaptı
        return view('posts.show', compact('post'));
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:160'],
            'body'  => ['nullable','string'],
        ]);

        // slug üret ve benzersiz yap
        $base = Str::slug($validated['title']);
        $slug = $base ?: Str::random(8);

        $i = 2;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        $post = Post::create([
            'title'    => $validated['title'],
            'slug'     => $slug,
            'body'     => $validated['body'] ?? null,
            'is_draft' => true,              // kullanıcı oluşturunca taslak kalsın
            'user_id'  => Auth::id(),
        ]);

        return redirect()->route('posts.show', $post)
            ->with('status', 'Taslak oluşturuldu! (Admin yayınlayınca akışa düşecek)');
    }
}
