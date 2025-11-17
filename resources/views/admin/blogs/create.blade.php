<div class="modal fade" id="createBlogModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Title *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Short Description *</label>
                        <textarea name="short_description" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Content *</label>
                       <textarea name="content" id="createBlogEditor" class="form-control"></textarea>

                    </div>

                    <div class="mb-3">
                        <label>Image *</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Create Blog</button>
                </div>

            </form>

        </div>
    </div>
</div>
