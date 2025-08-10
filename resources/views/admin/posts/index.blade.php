<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Paneli - Yazı Yönetimi</title>

    {{-- Modern bir font ekleyelim (Google Fonts) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Değişkenleri ile Renk Paleti */
        :root {
            --primary-color: #0d6efd; /* Canlı Mavi */
            --success-color: #198754; /* Yeşil */
            --background-color: #f8f9fa;
            --card-background: #ffffff;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --border-color: #dee2e6;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Genel Sayfa Ayarları */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-primary);
            margin: 0;
            line-height: 1.6;
        }

        /* Ana Konteyner */
        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        /* Sayfa Başlığı ve Admin Butonu */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }
        .page-header .btn-link {
            text-decoration: none;
            padding: 0.5rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
            background-color: var(--card-background);
            transition: all 0.2s ease;
        }
        .page-header .btn-link:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        /* Başarı Mesajı */
        .status-message {
            margin-bottom: 1.5rem;
            border-radius: 8px;
            border: 1px solid #a3cfbb;
            background-color: #d1e7dd;
            padding: 1rem;
            font-size: 0.9rem;
            color: #0a3622;
        }

        /* İki Sütunlu Grid Yapısı */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        /* Kart Yapısı */
        .post-card {
            background-color: var(--card-background);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: var(--shadow);
        }
        .card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            font-size: 1.1rem;
            font-weight: 600;
        }
        .card-body {
            padding: 0.75rem;
        }

        /* Liste Öğesi */
        .post-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }
        .post-item:hover {
            background-color: #f8f9fa;
        }
        .post-info a {
            font-weight: 500;
            color: var(--text-primary);
            text-decoration: none;
        }
        .post-info a:hover {
            color: var(--primary-color);
        }
        .post-info span {
            display: block;
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        /* Butonlar */
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.2s ease;
        }
        .btn-publish {
            background-color: var(--success-color);
            color: white;
        }
        .btn-publish:hover {
            background-color: #157347;
        }
        .btn-draft {
            background-color: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }
        .btn-draft:hover {
            background-color: var(--text-secondary);
            color: white;
        }

        /* Liste Boşsa Gösterilecek Mesaj */
        .empty-state {
            padding: 2rem;
            text-align: center;
            color: var(--text-secondary);
        }

        /* Mobil Cihazlar için Media Query */
        @media (max-width: 992px) {
            .content-grid {
                grid-template-columns: 1fr; /* Sütunları alt alta getir */
            }
        }
    </style>
</head>
<body>

<div class="admin-container">

    <header class="page-header">
        <h1>Yazı Yönetimi</h1>
        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('posts.index') }}" class="btn-link">Siteye Dön</a>
            @endif
        @endauth
    </header>

    @if(session('status'))
        <div class="status-message">
            {{ session('status') }}
        </div>
    @endif

    <main class="content-grid">

        {{-- TASLAKLAR KARTI --}}
        <section class="post-card">
            <header class="card-header">
                Onay Bekleyen Taslaklar
            </header>
            <div class="card-body">
                @forelse($drafts as $post)
                    <div class="post-item">
                        <div class="post-info">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            <span>— {{ $post->user->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('admin.posts.publish', $post) }}">
                            @csrf @method('PATCH')
                            <button class="btn btn-publish">Yayınla</button>
                        </form>
                    </div>
                @empty
                    <div class="empty-state">
                        <p>Onay bekleyen taslak bulunmuyor.</p>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- YAYINDA OLANLAR KARTI --}}
        <section class="post-card">
            <header class="card-header">
                Yayındaki Yazılar
            </header>
            <div class="card-body">
                @forelse($published as $post)
                    <div class="post-item">
                        <div class="post-info">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            <span>— {{ $post->user->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('admin.posts.draft', $post) }}">
                            @csrf @method('PATCH')
                            <button class="btn btn-draft">Taslağa Al</button>
                        </form>
                    </div>
                @empty
                    <div class="empty-state">
                        <p>Henüz yayınlanmış yazı yok.</p>
                    </div>
                @endforelse
            </div>
        </section>

    </main>

</div>

</body>
</html>
