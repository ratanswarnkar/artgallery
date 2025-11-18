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
        'slug'   => 'nullable|string|max:255',
        'seo_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
        'short_description' => 'nullable|string|max:500',
        'status' => 'required|in:draft,published',
        'content' => 'required|string',
        'image'   => 'nullable|image|max:4096',
    ]);

    $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
    $originalSlug = $slug;
    $counter = 1;
    while (Blog::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter++;
    }
    $data['slug'] = $slug;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/blogs'), $filename);
        $data['image'] = $filename;
    }

    Blog::create($data);

    return back()->with('success', 'Blog created successfully!');
}


public function update(Request $request, Blog $blog)
{
    $data = $request->validate([
        'title'   => 'required|string|max:255',
        'slug'   => 'nullable|string|max:255',
        'seo_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
        'short_description' => 'nullable|string|max:500',
        'status' => 'required|in:draft,published',
        'content' => 'required|string',
        'image'   => 'nullable|image|max:4096',
    ]);

    if ($request->slug != $blog->slug) {
        $slug = Str::slug($request->slug ?: $request->title);
        $originalSlug = $slug;
        $counter = 1;
        while (Blog::where('slug', $slug)->where('id','!=',$blog->id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $data['slug'] = $slug;
    }

    if ($request->hasFile('image')) {
        if ($blog->image && file_exists(public_path('uploads/blogs/'.$blog->image))) {
            @unlink(public_path('uploads/blogs/'.$blog->image));
        }
        $file = $request->file('image');
        $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/blogs'), $filename);
        $data['image'] = $filename;
    }

    $blog->update($data);

    return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');

}

public function create()
{
    return view('admin.blogs.create');
}

public function edit(Blog $blog)
{
    return view('admin.blogs.edit', compact('blog'));
}

public function destroy(Blog $blog)
{
    if ($blog->image && file_exists(public_path('uploads/blogs/'.$blog->image))) {
        @unlink(public_path('uploads/blogs/'.$blog->image));
    }

    $blog->delete();
    return back()->with('success', 'Blog deleted successfully!');
}

public function toggleStatus(Blog $blog)
{
    $blog->status = $blog->status === 'published' ? 'draft' : 'published';
    $blog->save();

    return back()->with('success', 'Blog status updated!');
}



}
