<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'profilepicture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function postcomments(): HasMany
    {
        return $this->hasMany(Postcomment::class);
    }

    public function postlikes(): HasMany
    {
        return $this->hasMany(Postlike::class);
    }

    public function message(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public static function getFollowed($id): Collection
    {
        return User::whereIn('id', Follow::where('follower', $id)->get('followed'))->get();
    }

    public static function getFollowers($id): Collection
    {
        return User::whereIn('id', Follow::where('followed', $id)->get('follower'))->get();
    }
}
