<div class="modal fade" id="editBlogModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form id="editBlogForm" method="POST" enctype="multipart/form-data">
                @csrf @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Title *</label>
                        <input type="text" name="title" id="editTitle" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Short Description *</label>
                        <textarea name="short_description" id="editShort" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Content *</label>
                       <textarea name="content" id="editBlogEditor" class="form-control"></textarea>

                    </div>

                    <div class="mb-3">
                        <label>Change Image (optional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update Blog</button>
                </div>

            </form>

        </div>
    </div>
</div>
