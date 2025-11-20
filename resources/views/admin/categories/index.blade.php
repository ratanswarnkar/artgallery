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

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Category Table -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>


                        <td class="fw-semibold">{{ $category->name }}</td>

                        <td class="text-muted">{{ $category->slug }}</td>

                        <td class="text-muted">{{ Str::limit($category->description, 40) }}</td>

                        <td>
                            @if($category->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>

                        <td>
                            <!-- Edit Button -->
                            <button 
                                class="btn btn-sm btn-info"
                                data-bs-toggle="modal"
                                data-bs-target="#editCategoryModal"
                                data-id="{{ $category->id }}"
                                data-name="{{ $category->name }}"
                                data-slug="{{ $category->slug }}"
                                data-description="{{ $category->description }}"
                                data-status="{{ $category->status }}"
                            >
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <!-- Delete Button -->
                            <button 
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteCategoryModal"
                                data-id="{{ $category->id }}"
                            >
                                <i class="bi bi-trash"></i>
                            </button>

                        </td>
                    </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $categories->links() }}
    </div>

</div>


{{-- ---------------- CREATE MODAL ---------------- --}}
<div class="modal fade" id="createCategoryModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Create Category</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" class="form-control" required placeholder="Enter category name">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Slug</label>
            <input type="text" name="slug" class="form-control" placeholder="auto-generate if blank">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save</button>
        </div>

      </form>

    </div>
  </div>
</div>


{{-- ---------------- EDIT MODAL ---------------- --}}
<div class="modal fade" id="editCategoryModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Edit Category</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form id="editCategoryForm" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" id="edit_name" name="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Slug</label>
            <input type="text" id="edit_slug" name="slug" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Description</label>
            <textarea id="edit_description" name="description" class="form-control" rows="3"></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </form>

    </div>
  </div>
</div>


{{-- ---------------- DELETE MODAL ---------------- --}}
<div class="modal fade" id="deleteCategoryModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Delete Category</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form id="deleteCategoryForm" method="POST">
        @csrf
        @method('DELETE')

        <div class="modal-body">
          <p class="fw-semibold mb-0">Are you sure you want to delete this category?</p>
          <small class="text-muted">This action cannot be undone.</small>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </div>

      </form>

    </div>
  </div>
</div>


@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Handle Edit Modal
    var editModal = document.getElementById('editCategoryModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button     = event.relatedTarget;
        var id         = button.getAttribute('data-id');
        var name       = button.getAttribute('data-name');
        var slug       = button.getAttribute('data-slug');
        var desc       = button.getAttribute('data-description');

        document.getElementById('edit_name').value        = name;
        document.getElementById('edit_slug').value        = slug;
        document.getElementById('edit_description').value = desc;

        document.getElementById('editCategoryForm').action =
            "/admin/categories/" + id;
    });

    // Handle Delete Modal
    var deleteModal = document.getElementById('deleteCategoryModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var id = event.relatedTarget.getAttribute('data-id');
        document.getElementById('deleteCategoryForm').action =
            "/admin/categories/" + id;
    });

});
</script>
@endpush
