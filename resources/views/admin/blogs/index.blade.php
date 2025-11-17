@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Blog Management</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBlogModal">+ Add Blog</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-3">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        @if($blog->image)
                            <img src="{{ asset('uploads/blogs/'.$blog->image) }}" width="60" height="60" class="rounded">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>

                    <td>{{ $blog->title }}</td>

                    <td>
                        <form action="{{ route('admin.blogs.toggle', $blog->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm {{ $blog->status == 'active' ? 'btn-success' : 'btn-secondary' }}">
                                {{ ucfirst($blog->status) }}
                            </button>
                        </form>
                    </td>

                    <td>
                        <button class="btn btn-info btn-sm editBlogBtn"
                            data-id="{{ $blog->id }}"
                            data-title="{{ $blog->title }}"
                            data-short="{{ $blog->short_description }}"
                            data-content="{{ htmlspecialchars($blog->content) }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editBlogModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure want to delete this blog?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>

                        <form action="{{ route('admin.blogs.toggle', $blog->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-dark btn-sm">
                                {{ $blog->status == 'active' ? 'Block' : 'Unblock' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No blogs found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $blogs->links() }}
        </div>
    </div>
</div>
@section('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
function loadTiny(selector) {
    tinymce.init({
        selector: selector,
        height: 350,
        menubar: true,
        plugins: 'print preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media table charmap hr pagebreak nonbreaking anchor lists wordcount help emoticons',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | ' +
            'alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | ' +
            'link image media table anchor | forecolor backcolor removeformat | preview code fullscreen',
        toolbar_sticky: true,
        image_title: true,
        automatic_uploads: true,
    });
}

/* CREATE BLOG MODAL */
document.getElementById('createBlogModal').addEventListener('shown.bs.modal', function () {
    setTimeout(() => {
        tinymce.remove("#createBlogEditor");
        loadTiny("#createBlogEditor");
    }, 200);
});

/* EDIT BLOG MODAL */
document.querySelectorAll('.editBlogBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        let id      = this.dataset.id;
        let title   = this.dataset.title;
        let shortD  = this.dataset.short;
        let content = this.dataset.content;

        document.getElementById('editBlogForm').action = "/admin/blogs/update/" + id;
        document.getElementById('editTitle').value = title;
        document.getElementById('editShort').value = shortD;

        setTimeout(() => {
            tinymce.remove("#editBlogEditor");
            loadTiny("#editBlogEditor");
            tinymce.get("editBlogEditor").setContent(content);
        }, 200);
    });
});

/* Make sure content is saved before submit */
document.addEventListener("submit", function() {
    if (tinymce.get("createBlogEditor")) tinymce.get("createBlogEditor").save();
    if (tinymce.get("editBlogEditor")) tinymce.get("editBlogEditor").save();
});
</script>
@endsection


@include('admin.blogs.create')
@include('admin.blogs.edit')

@endsection


