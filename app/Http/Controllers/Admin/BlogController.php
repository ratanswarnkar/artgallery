<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'content' => 'required|string',
            'image'   => 'required|image|max:4096',
        ]);

        // Auto-generate slug
        $data['slug'] = Str::slug($request->title);

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Blog::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Upload Image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $filename);
            $data['image'] = $filename;
        }

        // Default status
        $data['status'] = 'active';

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:4096',
        ]);

        // Generate slug again on title change
        $newSlug = Str::slug($request->title);

        if ($newSlug != $blog->slug) {
            $originalSlug = $newSlug;
            $counter = 1;
            while (Blog::where('slug', $newSlug)->where('id', '!=', $blog->id)->exists()) {
                $newSlug = $originalSlug . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $newSlug;
        }

        // Image upload
        if ($request->hasFile('image')) {
            if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image))) {
                @unlink(public_path('uploads/blogs/' . $blog->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $filename);
            $data['image'] = $filename;
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image))) {
            @unlink(public_path('uploads/blogs/' . $blog->image));
        }

        $blog->delete();

        return back()->with('success', 'Blog deleted successfully!');
    }

    public function toggleStatus(Blog $blog)
    {
        $blog->status = $blog->status == 'active' ? 'inactive' : 'active';
        $blog->save();

        return back()->with('success', 'Status Updated!');
    }
}
