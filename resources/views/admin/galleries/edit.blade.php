<div class="modal fade" id="editGalleryModal{{ $gallery->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit Gallery Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">

                <div class="col-md-6">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Location *</label>
                    <input type="text" name="location" class="form-control" value="{{ $gallery->location }}" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ $gallery->description }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">

                    @if($gallery->image)
                        <div class="mt-2">
                            <img src="{{ asset('uploads/galleries/'.$gallery->image) }}"
                                 width="100" class="rounded">
                        </div>
                    @endif
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Update</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>

        </form>
    </div>
</div>
