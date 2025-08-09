<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yazılar</title>
</head>
<body>
<h1>Yayınlanmış Yazılar</h1>

<ul>
    @forelse($posts as $post)
        <li>
            <a href="{{ route('posts.show', $post) }}">
                {{ $post->title }}
            </a>
        </li>
    @empty
        <li>Henüz yayınlanmış yazı yok.</li>
    @endforelse
</ul>
</body>
</html>
