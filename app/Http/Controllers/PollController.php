<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Vote;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function index()
    {
        $data = [
            'polls' => Poll::with('options')->latest()
        ];
        // $polls = Poll::with('options')->get();
        return view('admin.upload', $data);
    }

    public function showPoll()
    {
        $poll = Poll::with('options')->latest()->first();
        $userVote = null;

        if ($poll && Auth::check()) {
            $userVote = Vote::where('poll_id', $poll->id)
                ->where('user_id', Auth::id())
                ->first();
        }

        return view('poll.show', compact('poll', 'userVote'));
    }

    public function vote(Request $request, Poll $poll)
    {
        $optionId = $request->input('option');
        $option = $poll->options->find($optionId);

        if (!$option) {
            return redirect()->back()->with('error', 'Invalid option selected.');
        }

        $userVote = Vote::where('poll_id', $poll->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($userVote) {
            return redirect()->back()->with('error', 'Anda telah melakukan vote pada aplikasi ini.');
        }

        Vote::create([
            'poll_id' => $poll->id,
            'option_id' => $option->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Terima kasih telah memilih!');
    }

    public function createPollForm()
    {
        return view('admin.create');
    }

    public function storePoll(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        $poll = Poll::create([
            'question' => $request->input('question'),
        ]);

        $options = array_map(function ($option) {
            return ['name' => $option];
        }, $request->input('options'));

        $poll->options()->createMany($options);

        return redirect()->route('admin.poll.create')->with('success', 'Poll created successfully!');
    }
}
