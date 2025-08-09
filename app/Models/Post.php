<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'is_draft',
        'user_id',
    ];

    protected $casts = [
        'is_draft' => 'boolean',
    ];

    // İlişki: Post bir kullanıcıya aittir
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Route model binding
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Query scope: yayınlanmış yazılar
    public function scopePublished($query)
    {
        return $query->where('is_draft', false);
    }

    // Query scope: taslak yazılar
    public function scopeDraft($query)
    {
        return $query->where('is_draft', true);
    }
}
