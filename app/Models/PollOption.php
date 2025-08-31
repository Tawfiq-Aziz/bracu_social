<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PollOption extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'poll_id',
        'option_text',
        'votes_count'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    public function getPercentageAttribute()
    {
        $totalVotes = $this->poll->total_votes;
        return $totalVotes > 0 ? round(($this->votes_count / $totalVotes) * 100, 1) : 0;
    }
}
