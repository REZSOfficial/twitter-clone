<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Type\Integer;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'text',
        'img'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function postcomments(): HasMany
    {
        return $this->hasMany(Postcomment::class);
    }

    public function postlikes(): HasMany
    {
        return $this->hasMany(Postlike::class);
    }

    public static function getPostCount($id): int
    {
        return Post::where('user_id', $id)->count();
    }
}
