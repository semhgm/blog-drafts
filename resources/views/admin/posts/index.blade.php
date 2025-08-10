{{-- Taslaklar listesi --}}
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

@auth
    @if(auth()->user()->is_admin)
        <a href="{{ route('admin.posts.index') }}" class="px-3 py-1.5 rounded-lg border text-sm">Admin</a>
    @endif
@endauth
@if(session('status'))
    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">
        {{ session('status') }}
    </div>
@endif
@foreach($drafts as $post)
    <div class="flex items-center justify-between py-2">
        <div>
            <a href="{{ route('posts.show', $post) }}" class="font-medium">{{ $post->title }}</a>
            <span class="text-xs text-neutral-500">— {{ $post->user->name }}</span>
        </div>
        <form method="POST" action="{{ route('admin.posts.publish', $post) }}">
            @csrf @method('PATCH')
            <button class="px-3 py-1.5 rounded bg-emerald-600 text-white text-sm">Yayınla</button>
        </form>
    </div>
@endforeach

{{-- Yayında olanlar listesi --}}
@foreach($published as $post)
    <div class="flex items-center justify-between py-2">
        <div>
            <a href="{{ route('posts.show', $post) }}" class="font-medium">{{ $post->title }}</a>
            <span class="text-xs text-neutral-500">— {{ $post->user->name }}</span>
        </div>
        <form method="POST" action="{{ route('admin.posts.draft', $post) }}">
            @csrf @method('PATCH')
            <button class="px-3 py-1.5 rounded border text-sm">Taslağa Al</button>
        </form>
    </div>
@endforeach
</body>
</html>

