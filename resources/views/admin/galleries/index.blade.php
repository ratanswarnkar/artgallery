@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">All Galleries</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGalleryModal">
            + Create Gallery
        </button>
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
                    <th>Location</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th width="230">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($galleries as $gallery)
                <tr>
                   <td>{{ $loop->iteration }}</td>


                    <td>
                        @if($gallery->image)
                            <img src="{{ asset('uploads/users/'.$gallery->image) }}" width="60" height="60" class="rounded">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>

                    <td>{{ $gallery->title }}</td>

                    <td>{{ $gallery->location ?? '---' }}</td>

                    <td>{{ Str::limit($gallery->description, 40) }}</td>

                    <td>
                        <form action="{{ route('admin.galleries.toggleStatus', $gallery->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm {{ $gallery->status == 'active' ? 'btn-success' : 'btn-secondary' }}">
                                {{ ucfirst($gallery->status) }}
                            </button>
                        </form>
                    </td>

                    <td>
                        <button class="btn btn-sm btn-info editGalleryBtn"
                            data-id="{{ $gallery->id }}"
                            data-title="{{ $gallery->title }}"
                            data-location="{{ $gallery->location }}"
                            data-description="{{ $gallery->description }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editGalleryModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure want to delete?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>

                        <form action="{{ route('admin.galleries.toggleStatus', $gallery->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-dark">
                                {{ $gallery->status == 'active' ? 'Block' : 'Unblock' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No galleries found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $galleries->links() }}
        </div>
    </div>

</div>


<!-- CREATE MODAL -->
<div class="modal fade" id="createGalleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Title *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Location *</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Description *</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Image *</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Create Gallery</button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- EDIT MODAL -->
<div class="modal fade" id="editGalleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

           <form id="editGalleryForm" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="gallery_id" id="editGalleryId">

                    <div class="mb-3">
                        <label>Title *</label>
                        <input type="text" name="title" id="editTitle" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Location *</label>
                        <input type="text" name="location" id="editLocation" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Description *</label>
                        <textarea name="description" id="editDescription" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Change Image (optional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update Gallery</button>
                </div>

            </form>

        </div>
    </div>
</div>


<script>
document.querySelectorAll('.editGalleryBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        let id = this.dataset.id;
        document.getElementById('editGalleryId').value = id;
        document.getElementById('editTitle').value = this.dataset.title;
        document.getElementById('editLocation').value = this.dataset.location;
        document.getElementById('editDescription').value = this.dataset.description;
        
        document.getElementById('editGalleryForm').action =
            "/admin/galleries/" + id; // 👈 correct route
    });
});

</script>

@endsection
