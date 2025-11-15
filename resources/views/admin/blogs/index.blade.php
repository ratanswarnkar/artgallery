@extends('admin.layout')

@section('title', 'Blogs')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Blogs</h2>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBlogModal">
        <i class="bi bi-plus-circle"></i> Create Blog
    </button>
</div>

<!-- Blog Cards -->
<div class="row g-4">

    @foreach (range(1,8) as $i)
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">

            <!-- Blog Thumbnail -->
            <img 
                src="https://picsum.photos/400/250?random={{ $i }}" 
                class="card-img-top" 
                alt="Blog Image"
                style="height: 170px; object-fit: cover;"
            >

            <div class="card-body">
                <h5 class="card-title fw-bold">Sample Blog {{ $i }}</h5>
                <p class="text-muted small">Updated {{ $i }} days ago</p>

                <a href="#" class="btn btn-sm btn-outline-primary w-100">
                    <i class="bi bi-eye"></i> Read More
                </a>
            </div>

        </div>
    </div>
    @endforeach

</div>


<!-- CREATE BLOG MODAL -->
<div class="modal fade" id="createBlogModal" tabindex="-1" aria-labelledby="createBlogLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="createBlogLabel">Create Blog</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form>

            <!-- Blog Title -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Blog Title</label>
                <input type="text" class="form-control" placeholder="Enter blog title">
            </div>

            <!-- Blog Image -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Featured Image</label>
                <input type="file" class="form-control">
            </div>

            <!-- CKEditor -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Blog Description</label>
                <textarea id="blogDescription" class="form-control"></textarea>
            </div>

        </form>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success">Save Blog </button>
      </div>

    </div>
  </div>
</div>

@endsection


@push('scripts')
<!-- CKEditor 4 Full -->
<script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>

<script>
    CKEDITOR.replace('blogDescription', {
        height: 300,
        extraPlugins: 'colorbutton,font,justify,image2',
        removeButtons: ''
    });
</script>
@endpush
