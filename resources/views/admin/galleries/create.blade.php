<div class="modal fade" id="createGalleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Add Gallery Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">
                
                <div class="col-md-6">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Location *</label>
                    <input type="text" name="location" class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">Image *</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>

        </form>
    </div>
</div>
