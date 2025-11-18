<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'event_time'  => 'required',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:4096',
        ]);

        // slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        while (Event::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;
        }
        $data['slug'] = $slug;

        // image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/events'), $filename);
            $data['image'] = $filename;
        }

        $data['status'] = 'active';

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'event_time'  => 'required',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:4096',
        ]);

        // update slug if title changed
        $newSlug = Str::slug($request->title);
        if ($newSlug !== $event->slug) {
            $originalSlug = $newSlug;
            $counter = 1;
            while (Event::where('slug', $newSlug)->where('id', '!=', $event->id)->exists()) {
                $newSlug = $originalSlug.'-'.$counter;
                $counter++;
            }
            $data['slug'] = $newSlug;
        }

        if ($request->hasFile('image')) {
            if ($event->image && file_exists(public_path('uploads/events/'.$event->image))) {
                @unlink(public_path('uploads/events/'.$event->image));
            }

            $file = $request->file('image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/events'), $filename);
            $data['image'] = $filename;
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        if ($event->image && file_exists(public_path('uploads/events/'.$event->image))) {
            @unlink(public_path('uploads/events/'.$event->image));
        }

        $event->delete();

        return back()->with('success', 'Event deleted successfully!');
    }

    public function toggleStatus(Event $event)
    {
        $event->status = $event->status === 'active' ? 'inactive' : 'active';
        $event->save();

        return back()->with('success', 'Status updated!');
    }
}
