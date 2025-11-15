<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Painting;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaintingController extends Controller
{
    public function index()
    {
        $paintings = Painting::with('artist','category','gallery')->latest()->paginate(15);
        return view('admin.paintings.index', compact('paintings'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $artists = Artist::pluck('name', 'id')->toArray();
        $galleries = Gallery::pluck('name', 'id')->toArray();

        return view('admin.paintings.create', compact('categories', 'artists', 'galleries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'nullable|exists:artists,id',
            'category_id' => 'nullable|exists:categories,id',
            'gallery_id' => 'nullable|exists:galleries,id',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'status' => 'required|in:active,inactive,sold',
            'image' => 'nullable|image|max:5120',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/paintings'), $filename);
            $data['image'] = $filename;
        }

        Painting::create($data);

        return redirect()->route('admin.paintings.index')->with('success','Painting created.');
    }

    public function show(Painting $painting)
    {
        return view('admin.paintings.show', compact('painting'));
    }

    public function edit(Painting $painting)
    {
        $artists = Artist::pluck('name','id');
        $categories = Category::pluck('name','id');
        $galleries = Gallery::pluck('name','id');

        return view('admin.paintings.edit', compact('painting','artists','categories','galleries'));
    }

    public function update(Request $request, Painting $painting)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'nullable|exists:artists,id',
            'category_id' => 'nullable|exists:categories,id',
            'gallery_id' => 'nullable|exists:galleries,id',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'status' => 'required|in:active,inactive,sold',
            'image' => 'nullable|image|max:5120',
        ]);

        // Handle new image upload
        if ($request->hasFile('image')) {

            // Delete old file
            if ($painting->image && file_exists(public_path('uploads/paintings/'.$painting->image))) {
                @unlink(public_path('uploads/paintings/'.$painting->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/paintings'), $filename);
            $data['image'] = $filename;
        }

        $painting->update($data);

        return redirect()->route('admin.paintings.index')->with('success','Painting updated.');
    }

    public function destroy(Painting $painting)
    {
        if ($painting->image && file_exists(public_path('uploads/paintings/'.$painting->image))) {
            @unlink(public_path('uploads/paintings/'.$painting->image));
        }

        $painting->delete();

        return redirect()->route('admin.paintings.index')->with('success','Painting deleted.');
    }

    public function toggle(Painting $painting)
    {
        $painting->status = $painting->status === 'active' ? 'inactive' : 'active';
        $painting->save();
        return back()->with('success','Status updated.');
    }

    public function toggleStatus(Painting $painting)
    {
        if ($painting->status === 'active') {
            $painting->status = 'inactive';
        } elseif ($painting->status === 'inactive') {
            $painting->status = 'sold';
        } elseif ($painting->status === 'sold') {
            $painting->status = 'active';
        }

        $painting->save();

        return redirect()->back()->with('success', 'Painting status updated!');
    }
}
