@extends('admin.layout')

@section('title', 'Edit Admin User')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Edit Admin User</h2>
        <a href="{{ route('admin.admin-users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger shadow-sm">
                    <strong>Fix these errors:</strong>
                    <ul class="my-2">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.admin-users.update', $admin_user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="fw-semibold">Name</label>
                    <input type="text" name="name" 
                           value="{{ $admin_user->name }}" 
                           class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Email (User ID)</label>
                    <input type="email" name="email" 
                           value="{{ $admin_user->email }}" 
                           class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">New Password (optional)</label>
                    <input type="password" name="password" class="form-control rounded-3">
                    <small class="text-muted">Leave blank to keep existing password.</small>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Status</label>
                    <select name="status" class="form-control rounded-3">
                        <option value="active" {{ $admin_user->status == "active" ? "selected" : "" }}>Active</option>
                        <option value="inactive" {{ $admin_user->status == "inactive" ? "selected" : "" }}>Inactive</option>
                    </select>
                </div>

                <button class="btn btn-primary px-4 mt-2" type="submit">
                    <i class="bi bi-save"></i> Update User
                </button>

            </form>

        </div>
    </div>

</div>
@endsection
