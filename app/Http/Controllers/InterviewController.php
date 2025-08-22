<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InterviewController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $interviews = Interview::with(['employer', 'developer', 'jobPost'])
            ->where(function ($q) use ($user) {
                $q->where('employer_id', $user->id)
                  ->orWhere('developer_id', $user->id);
            })
            ->orderBy('scheduled_at')
            ->paginate(20);

        $developers = User::where('role', 'Developer')
            ->orderBy('name')
            ->limit(50)
            ->get(['id', 'name']);

        return view('interviews.index', compact('interviews', 'developers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'developer_id' => [
                'required',
                Rule::exists('users', 'id')->where('role', 'Developer'),
            ],
            'job_post_id'  => ['nullable', 'exists:job_posts,id'],
            'title'        => ['required', 'string', 'max:255'],
            'type'         => ['required', 'in:interview,meeting,milestone'],
            'location'     => ['nullable', 'string', 'max:255'],
            'notes'        => ['nullable', 'string'],
            'scheduled_at' => ['required', 'date'],
            'duration_minutes'        => ['nullable', 'integer', 'min:5', 'max:600'],
            'reminder_minutes_before' => ['nullable', 'integer', 'min:5', 'max:1440'],
        ]);

        $data = $request->only([
            'developer_id', 'job_post_id', 'title', 'type', 'location', 'notes',
            'scheduled_at', 'duration_minutes', 'reminder_minutes_before'
        ]);

        $data['employer_id'] = Auth::id();
        $data['duration_minutes'] = $data['duration_minutes'] ?? 30;
        $data['reminder_minutes_before'] = $data['reminder_minutes_before'] ?? 60;

        Interview::create($data);

        return redirect()->route('interviews.index')->with('success', 'Scheduled successfully.');
    }

    public function updateStatus(Interview $interview, Request $request)
    {
        $request->validate(['status' => 'required|in:scheduled,completed,cancelled']);

        abort_unless(
            in_array(Auth::id(), [$interview->employer_id, $interview->developer_id]),
            403
        );

        $interview->update(['status' => $request->status]);

        if (in_array($request->status, ['completed', 'cancelled'], true)) {
            $this->deleteEventFromCalendar($interview);
            return back()->with('success', 'Status updated and event removed from calendar.');
        }

        return back()->with('success', 'Status updated.');
    }

    public function ics(Interview $interview)
    {
        abort_unless(in_array(auth()->id(), [$interview->employer_id, $interview->developer_id]), 403);

        $start = $interview->scheduled_at->copy()->utc();
        $end   = $start->copy()->addMinutes($interview->duration_minutes ?? 30);

        $summary     = addcslashes($interview->title ?? 'Event', ",;\\");
        $location    = addcslashes($interview->location ?? 'TBD', ",;\\");
        $description = addcslashes($interview->notes ?? '', ",;\\");
        $uid = 'devconnect-' . $interview->id . '@' . request()->getHost();

        $location = $interview->location ?? 'TBD';
        if (filter_var($location, FILTER_VALIDATE_URL)) {
            $description .= "\nLocation URL: $location"; 
            $location = 'URL - Not Clickable in ICS';
        }


        $ics = "BEGIN:VCALENDAR\r\n" .
               "VERSION:2.0\r\n" .
               "PRODID:-//DevConnect//Calendar//EN\r\n" .
               "CALSCALE:GREGORIAN\r\n" .
               "METHOD:PUBLISH\r\n" .
               "BEGIN:VEVENT\r\n" .
               "UID:{$uid}\r\n" .
               "DTSTAMP:" . $start->format('Ymd\THis\Z') . "\r\n" .
               "DTSTART:" . $start->format('Ymd\THis\Z') . "\r\n" .
               "DTEND:" . $end->format('Ymd\THis\Z') . "\r\n" .
               "SUMMARY:{$summary}\r\n" .
               "LOCATION:{$location}\r\n" .
               "DESCRIPTION:{$description}\r\n" .
               "STATUS:CONFIRMED\r\n" .
               "END:VEVENT\r\n" .
               "END:VCALENDAR\r\n";

        return response($ics, 200, [
            'Content-Type'        => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename=devconnect-event-' . $interview->id . '.ics',
        ]);
    }

    public function edit(Interview $interview)
    {
        abort_unless(in_array(auth()->id(), [$interview->employer_id, $interview->developer_id]), 403);

        $developers = User::where('role', 'Developer')->get();
        return view('interviews.edit', compact('interview', 'developers'));
    }

    public function update(Request $request, Interview $interview)
    {
        $data = $request->validate([
            'developer_id' => [
                'required',
                Rule::exists('users', 'id')->where('role', 'Developer'),
            ],
            'job_post_id'  => 'nullable|exists:job_posts,id',
            'title'        => 'required|string|max:255',
            'type'         => 'required|in:interview,meeting,milestone',
            'location'     => 'nullable|string|max:255',
            'notes'        => 'nullable|string',
            'scheduled_at' => 'required|date',
            'duration_minutes'        => 'nullable|integer|min:5|max:600',
            'reminder_minutes_before' => 'nullable|integer|min:5|max:1440',
        ]);

        abort_unless(in_array(auth()->id(), [$interview->employer_id, $interview->developer_id]), 403);

        $interview->update($data);

        return redirect()->route('interviews.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Interview $interview)
    {
        abort_unless(in_array(auth()->id(), [$interview->employer_id, $interview->developer_id]), 403);

        $interview->delete();

        return redirect()->route('interviews.index')->with('success', 'Event deleted successfully.');
    }

    private function deleteEventFromCalendar(Interview $interview): void
    {
        if (Auth::id() === (int) $interview->employer_id) {
            $interview->delete(); 
        }
    }
}
