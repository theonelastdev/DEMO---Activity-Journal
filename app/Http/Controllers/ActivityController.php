<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->get();

        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:milestone,note',
        ]);

        Activity::create($data);

        return redirect()->route('activities.index');
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'nullable|string',
            'type' => 'required|in:milestone,note',
        ]);

        $record = Activity::findOrFail($activity->id);

        $record->update($data);

        return redirect()->route('activities.index');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }
}
