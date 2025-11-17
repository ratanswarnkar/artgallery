<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'location'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            $data['image'] = $filename;
        }

        // default status
        $data['status'] = 'active';

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery created successfully!');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'location'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image && file_exists(public_path('uploads/users/' . $gallery->image))) {
                @unlink(public_path('uploads/users/' . $gallery->image));
            }

            $file     = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galleries'), $filename);
            $data['image'] = $filename;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery updated successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && file_exists(public_path('uploads/users/' . $gallery->image))) {
            @unlink(public_path('uploads/users/' . $gallery->image));
        }

        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Gallery deleted successfully!');
    }

    public function toggleStatus(Gallery $gallery)
    {
        $gallery->status = $gallery->status == 'active' ? 'inactive' : 'active';
        $gallery->save();

        return back()->with('success', 'Status changed successfully!');
    }
}
