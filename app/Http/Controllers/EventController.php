<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::query()
            ->orderBy('event_date')
            ->get(['event_date', 'name'])
            ->map(function (Event $event) {
                return [
                    'event_date' => optional($event->event_date)->toDateString(),
                    'name' => $event->name,
                ];
            });
        return response()->json($events);
    }

    public function upsert(Request $request)
    {
        $validated = $request->validate([
            'event_date' => ['required', 'date'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        $event = Event::updateOrCreate(
            ['event_date' => $validated['event_date']],
            ['name' => $validated['name']]
        );

        return response()->json([
            'event_date' => optional($event->event_date)->toDateString(),
            'name' => $event->name,
        ]);
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'event_date' => ['required', 'date'],
        ]);

        Event::where('event_date', $validated['event_date'])->delete();
        return response()->json(['ok' => true]);
    }
}


