<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','body','user_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likesCount()
    {
        return $this->likes()->where('type', 'like')->count();
    }

    public function dislikesCount()
    {
        return $this->likes()->where('type', 'dislike')->count();
    }

    public function commentsCount()
    {
        return $this->comments()->count();
    }

    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->where('type', 'like')->exists();
    }

    public function isDislikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->where('type', 'dislike')->exists();
    }
}
