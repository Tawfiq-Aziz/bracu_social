<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poll extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'post_id',
        'question',
        'multiple_choice',
        'expires_at'
    ];

    protected $casts = [
        'multiple_choice' => 'boolean',
        'expires_at' => 'datetime'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    public function getTotalVotesAttribute()
    {
        return $this->votes()->count();
    }

    public function hasUserVoted($userId)
    {
        return $this->votes()->where('user_id', $userId)->exists();
    }

    public function getUserVotedOptions($userId)
    {
        return $this->votes()->where('user_id', $userId)->pluck('poll_option_id');
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
