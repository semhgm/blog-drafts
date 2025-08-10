<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tatlı Sözlük — Akış</title>

    <!-- Modern bir font ekleyelim (Google Fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS Stilleri -->
    <style>
        /* CSS Değişkenleri (Renk paletini buradan kolayca değiştirebilirsiniz) */
        :root {
            --primary-color: #059669; /* Zümrüt Yeşili */
            --primary-color-hover: #047857;
            --background-color: #f8fafc; /* Çok açık gri */
            --card-background-color: #ffffff;
            --text-color-primary: #1f2937; /* Koyu gri */
            --text-color-secondary: #6b7280; /* Orta gri */
            --border-color: #e5e7eb;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-hover: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -2px rgb(0 0 0 / 0.1);
        }

        /* Genel Sayfa Stilleri */
        body {
            font-family: 'Nunito Sans', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color-primary);
            margin: 0;
            line-height: 1.6;
        }

        /* Ana İçerik Konteyneri */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* Header (Üst Bar) */
        .site-header {
            background-color: var(--card-background-color);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.85);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
            text-decoration: none;
        }

        .header-nav a {
            text-decoration: none;
            color: var(--text-color-secondary);
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .header-nav a:hover {
            background-color: #f3f4f6;
            color: var(--text-color-primary);
        }

        /* Yazı Kartı Stili */
        .post-card {
            background-color: var(--card-background-color);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
            transition: box-shadow 0.3s ease;
        }

        .post-card:hover {
            box-shadow: var(--shadow-hover);
        }

        .post-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .avatar {
            width: 48px;
            height: 48px;
            background-color: #34d399; /* Avatar arkaplanı */
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .post-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        .post-meta {
            font-size: 0.85rem;
            color: var(--text-color-secondary);
        }

        .post-body {
            color: var(--text-color-primary);
            margin-bottom: 1.5rem;
        }

        .post-footer {
            display: flex;
            gap: 0.75rem;
        }

        /* Buton Stilleri */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Nunito Sans', sans-serif;
            text-decoration: none;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-secondary {
            background-color: #f3f4f6;
            color: var(--text-color-primary);
            border-color: #e5e7eb;
        }

        .btn-secondary:hover {
            background-color: #e5e7eb;
        }

        /* Notlar Kutusu */
        .notes-box {
            background: linear-gradient(135deg, #f0fdf4, #e0f2fe);
            border: 1px solid #d1fae5;
            border-radius: 16px;
            padding: 1.5rem;
            font-size: 0.9rem;
        }

        .notes-box h3 {
            margin-top: 0;
            font-weight: 700;
        }

        .notes-box .btn {
            margin-top: 1rem;
            background-color: var(--card-background-color);
        }

    </style>
</head>
<body>

<header class="site-header">
    <div class="header-content">
        <a href="#" class="logo">🍯 Tatlı Sözlük</a>
        <nav class="header-nav">
            <a href="#">Giriş</a>
        </nav>
    </div>
</header>

<main class="container">
    <!-- Yazı Kartı -->
    <article class="post-card">
        <ul>
            @forelse($posts as $post)
                <li>



        <header class="post-header">
            <div class="avatar">YA</div>
            <div>
                <h2 class="post-title">                    <a href="{{ route('posts.show', $post) }}">
                        {{ $post->title }}
                    </a></h2>
                <p class="post-meta">Yazar · 15 hours ago</p>
            </div>
        </header>
            @empty
                <li>Henüz yayınlanmış yazı yok.</li>
            @endforelse
        <footer class="post-footer">
            <a href="#" class="btn btn-secondary">
                <!-- SVG İkon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                </svg>
                Devamını Oku
            </a>
            <a href="#" class="btn btn-secondary">
                <!-- SVG İkon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
                </svg>
                Sayfaya Git
            </a>
        </footer>
                </li>
        </ul>
    </article>

    <!-- Tatlı Notlar Kutusu -->
    <aside class="notes-box">
        <h3>Tatlı Notlar</h3>
        <p>"Yazılar taslakta değilse akışa düşer." Admin panelinde taslakları yönetebilirsin. 🚀</p>
        <a href="http://127.0.0.1:8000/register" class="btn">Katıl ve Yaz</a>
    </aside>
</main>

</body>
</html>
