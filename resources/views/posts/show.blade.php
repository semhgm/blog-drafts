<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
</head>
<body>
<h1>{{ $post->title }}</h1>

@if($post->is_draft)
    <p><em>Bu yazı taslak durumunda, yalnızca yetkililer görebilir.</em></p>
@endif

<div>
    {!! nl2br(e($post->body)) !!}
</div>

<p>
    <a href="{{ route('posts.index') }}">← Listeye dön</a>
</p>
</body>
</html>
