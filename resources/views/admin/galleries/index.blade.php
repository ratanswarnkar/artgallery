@extends('admin.layout')

@section('title', 'Galleries')

@section('content')

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Galleries</h2>

       <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGalleryModal">
    <i class="bi bi-plus-circle"></i> Add Gallery
</button>

    </div>

   <!-- Create Gallery Modal -->
<div class="modal fade" id="createGalleryModal" tabindex="-1" aria-labelledby="createGalleryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">

      <!-- Header -->
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="createGalleryModalLabel">Create Gallery</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">

        <form>

            <!-- Gallery Name -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Gallery Name</label>
                <input type="text" class="form-control" placeholder="Enter gallery name">
            </div>

            <!-- Slug -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Slug</label>
                <input type="text" class="form-control" placeholder="auto-generated or type manually">
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea class="form-control" rows="3" placeholder="Write details about the gallery..."></textarea>
            </div>

            <!-- Optional Photo -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Gallery Image (optional)</label>
                <input type="file" class="form-control">
            </div>

        </form>

      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success">Save</button>
      </div>

    </div>
  </div>
</div>


    <!-- Gallery Cards Section -->
    <div class="row g-4">

        <!-- FAKE GALLERY CARD 1 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 gallery-card">
                <img src="https://images.pexels.com/photos/1671004/pexels-photo-1671004.jpeg"
                     class="card-img-top rounded-top-4"
                     style="height:180px; object-fit:cover;">

                <div class="card-body">
                    <h5 class="fw-bold">Modern Arts Exhibition</h5>
                    <p class="text-muted small">
                        A premium section showcasing modern artworks.
                    </p>

                    <span class="badge bg-success mb-3">Active</span>

                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-info disabled w-100">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>

                        <button class="btn btn-sm btn-danger disabled w-100">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAKE GALLERY CARD 2 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 gallery-card">
                <img src="https://images.pexels.com/photos/167092/pexels-photo-167092.jpeg"
                     class="card-img-top rounded-top-4"
                     style="height:180px; object-fit:cover;">

                <div class="card-body">
                    <h5 class="fw-bold">Classic Art Gallery</h5>
                    <p class="text-muted small">
                        Traditional artwork and historical masterpieces.
                    </p>

                    <span class="badge bg-secondary mb-3">Inactive</span>

                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-info disabled w-100">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>

                        <button class="btn btn-sm btn-danger disabled w-100">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAKE GALLERY CARD 3 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 gallery-card">
                <img src="https://images.pexels.com/photos/2041540/pexels-photo-2041540.jpeg"
                     class="card-img-top rounded-top-4"
                     style="height:180px; object-fit:cover;">

                <div class="card-body">
                    <h5 class="fw-bold">Photography Hall</h5>
                    <p class="text-muted small">
                        Digital and printed photography collection.
                    </p>

                    <span class="badge bg-success mb-3">Active</span>

                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-info disabled w-100">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>

                        <button class="btn btn-sm btn-danger disabled w-100">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
