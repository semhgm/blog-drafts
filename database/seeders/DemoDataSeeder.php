<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Yazar kullanıcı
        $author = User::create([
            'name' => 'Yazar',
            'email' => 'yazar@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Yayınlanmış yazı
        Post::create([
            'title' => 'Yayınlanmış İlk Yazı',
            'slug' => 'yayinlanmis-ilk-yazi',
            'body' => 'Bu yazı yayında ve herkese açık.',
            'is_draft' => false,
            'user_id' => $author->id,
        ]);

        // Taslak yazı
        Post::create([
            'title' => 'Taslak Yazı',
            'slug' => 'taslak-yazi',
            'body' => 'Bu yazı henüz taslak.',
            'is_draft' => true,
            'user_id' => $author->id,
        ]);
    }
}
