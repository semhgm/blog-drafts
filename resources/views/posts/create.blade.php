<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Başlık — Tatlı Sözlük</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-neutral-50 text-neutral-900">
<main class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-4">Yeni Başlık</h1>

    @if ($errors->any())
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm mb-1">Başlık</label>
            <input name="title" value="{{ old('title') }}" required
                   class="w-full rounded-xl border border-neutral-300 px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm mb-1">Metin</label>
            <textarea name="body" rows="8"
                      class="w-full rounded-xl border border-neutral-300 px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('body') }}</textarea>
        </div>

        <p class="text-xs text-neutral-500">Not: Gönderdiğin içerik önce <strong>taslak</strong> olarak kaydedilir.</p>

        <div class="flex gap-2">
            <button class="px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">Kaydet</button>
            <a href="{{ route('posts.index') }}" class="px-4 py-2 rounded-xl border border-neutral-300 hover:bg-neutral-100">Vazgeç</a>
        </div>
    </form>
</main>
</body>
</html>
