@extends('admin.layout')

@section('title', 'Categories')

@section('content')

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Categories</h2>

       <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
    <i class="bi bi-plus-circle"></i> Add Category
</button>

    </div>

    <!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">

      <!-- Header -->
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="createCategoryModalLabel">Create Category</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">

        <form>
          <div class="mb-3">
            <label class="form-label fw-semibold">Category Name</label>
            <input type="text" class="form-control" placeholder="Enter category name">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Slug</label>
            <input type="text" class="form-control" placeholder="auto-generated or type manually">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Description</label>
            <textarea class="form-control" rows="3" placeholder="Write details..."></textarea>
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

    <!-- Category Table -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Slug</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Fake sample row 1 -->
                    <tr>
                        <td>1</td>
                        <td>Abstract Art</td>
                        <td>Creative and modern art styles</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>abstract-art</td>
                        <td>
                            <button class="btn btn-sm btn-info disabled">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger disabled">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- Fake sample row 2 -->
                    <tr>
                        <td>2</td>
                        <td>Landscape</td>
                        <td>Natural scenery paintings</td>
                        <td><span class="badge bg-secondary">Inactive</span></td>
                        <td>landscape</td>
                        <td>
                            <button class="btn btn-sm btn-info disabled">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger disabled">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    <!-- Fake sample row 3 -->
                    <tr>
                        <td>3</td>
                        <td>Portrait</td>
                        <td>Human face & body art</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>portrait</td>
                        <td>
                            <button class="btn btn-sm btn-info disabled">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger disabled">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
