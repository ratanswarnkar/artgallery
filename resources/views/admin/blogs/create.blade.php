@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Create Blog</h2>

    <div class="card p-4">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Title *</label>
                <input type="text" name="title" id="title" class="form-control"
                       required onkeyup="generateSlug()">
            </div>

            <div class="mb-3">
                <label>Slug (Auto editable)</label>
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

</div>
@endsection

@section('scripts')
@include('admin.blogs.summernote-script')
@endsection
