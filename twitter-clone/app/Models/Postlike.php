<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Postlike extends Model
{
    protected $fillable = [
        'post_id',
        'user_id'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getUserLikes($id): array
    {
        return Postlike::where('user_id', $id)->pluck('post_id')->toArray();
    }
}
