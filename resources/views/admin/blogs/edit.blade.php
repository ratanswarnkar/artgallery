@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Edit Blog</h2>

    <div class="card p-4">
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
              enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Title *</label>
                <input type="text" name="title" id="title"
                       value="{{ $blog->title }}" class="form-control"
                       required onkeyup="generateSlug()">
            </div>

            <div class="mb-3">
                <label>Slug (Auto editable)</label>
                <input type="text" name="slug" id="slug" value="{{ $blog->slug }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Short Description *</label>
                <textarea name="short_description" class="form-control"
                          required>{{ $blog->short_description }}</textarea>
            </div>

            <div class="mb-3">
                <label>SEO Title</label>
                <input type="text" name="seo_title"
                       value="{{ $blog->seo_title }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Meta Description</label>
                <textarea name="meta_description"
                          class="form-control">{{ $blog->meta_description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="draft" {{ $blog->status=='draft'?'selected':'' }}>Draft</option>
                    <option value="published" {{ $blog->status=='published'?'selected':'' }}>Published</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Current Image</label><br>
                @if($blog->image)
                    <img src="{{ asset('uploads/blogs/'.$blog->image) }}" width="140" class="rounded mb-2">
                @else
                    <p class="text-danger">No Image uploaded</p>
                @endif
            </div>

            <div class="mb-3">
                <label>Change Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <label>Content *</label>
            <textarea name="content" id="blogContent" class="form-control"
                      required>{!! $blog->content !!}</textarea>

            <button class="btn btn-primary mt-3">Update Blog</button>

        </form>
    </div>

</div>
@endsection

@section('scripts')
@include('admin.blogs.summernote-script')
@endsection
