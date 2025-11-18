@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Blogs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4 mb-4">
        <h4>Create Blog</h4>
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Title *</label>
                <input type="text" name="title" id="title" class="form-control" required onkeyup="generateSlug()">
            </div>

            <div class="mb-3">
                <label>Slug (auto editable)</label>
                <input type="text" name="slug" id="slug" class="form-control">
            </div>

            <div class="mb-3">
                <label>Short Description *</label>
                <textarea name="short_description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>SEO Title</label>
                <input type="text" name="seo_title" class="form-control">
            </div>

            <div class="mb-3">
                <label>Meta Description</label>
                <textarea name="meta_description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <label>Content *</label>
            <textarea name="content" id="blogContent" class="form-control" required></textarea>

            <button class="btn btn-primary mt-3">Create Blog</button>
        </form>
    </div>

    <h4>All Blogs</h4>
    <div class="card p-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Short Desc</th>
                    <th>Status</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                <tr>
                    <td>{{ $blog->id }}</td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->slug }}</td>
                    <td>{{ Str::limit($blog->short_description, 30) }}</td>
                    <td>{{ $blog->status }}</td>
                    <td>{!! Str::limit(strip_tags($blog->content), 40) !!}</td>
                    <td>
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-info">✏ Edit</a>

                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" 
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this blog?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑 Delete</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $blogs->links() }}
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
function generateSlug() {
    let title = document.getElementById("title").value;
    let slug = title.toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/(^-|-$)/g,'');
    document.getElementById("slug").value = slug;
}

$(document).ready(function () {
    $('#blogContent').summernote({
        height: 250
    });
});
</script>
@endsection
