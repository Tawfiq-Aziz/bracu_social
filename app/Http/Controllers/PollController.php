<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PollController extends Controller
{
    public function vote(Request $request, Poll $poll)
    {
        $request->validate([
            'option_ids' => 'required|array',
            'option_ids.*' => 'exists:poll_options,id'
        ]);

        $userId = auth()->id();
        
        // Check if poll is expired
        if ($poll->isExpired()) {
            return redirect()->back()->with('error', 'This poll has expired.');
        }

        // Check if user has already voted
        if (!$poll->multiple_choice && $poll->hasUserVoted($userId)) {
            return redirect()->back()->with('error', 'You have already voted on this poll.');
        }

        DB::transaction(function () use ($poll, $request, $userId) {
            // If not multiple choice, remove any existing votes
            if (!$poll->multiple_choice) {
                $existingVotes = PollVote::where('poll_id', $poll->id)
                    ->where('user_id', $userId)
                    ->get();
                
                foreach ($existingVotes as $vote) {
                    $option = PollOption::find($vote->poll_option_id);
                    $option->decrement('votes_count');
                    $vote->delete();
                }
            }

            // Add new votes
            foreach ($request->option_ids as $optionId) {
                // Check if user already voted for this specific option
                $existingVote = PollVote::where('poll_id', $poll->id)
                    ->where('user_id', $userId)
                    ->where('poll_option_id', $optionId)
                    ->first();

                if (!$existingVote) {
                    PollVote::create([
                        'poll_id' => $poll->id,
                        'poll_option_id' => $optionId,
                        'user_id' => $userId
                    ]);

                    $option = PollOption::find($optionId);
                    $option->increment('votes_count');
                }
            }
        });

        return redirect()->back()->with('success', 'Your vote has been recorded!');
    }

    public function removeVote(Poll $poll)
    {
        $userId = auth()->id();
        
        DB::transaction(function () use ($poll, $userId) {
            $votes = PollVote::where('poll_id', $poll->id)
                ->where('user_id', $userId)
                ->get();

            foreach ($votes as $vote) {
                $option = PollOption::find($vote->poll_option_id);
                $option->decrement('votes_count');
                $vote->delete();
            }
        });

        return redirect()->back()->with('success', 'Your vote has been removed!');
    }

    public function deletePoll(Poll $poll)
    {
        // Check if the user owns the post that contains this poll
        if (auth()->id() != $poll->post->user_id) {
            return redirect()->back()->with('error', 'You can only delete polls from your own posts.');
        }
        
        // Delete the poll (this will cascade delete options and votes due to foreign key constraints)
        $poll->delete();
        
        return redirect()->back()->with('success', 'Poll has been deleted successfully!');
    }
}
