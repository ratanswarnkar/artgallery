@extends('admin.layout')

@section('title', 'Create Admin User')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Add New Admin User</h2>
        <a href="{{ route('admin.admin-users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger shadow-sm">
                    <strong>Fix the following errors:</strong>
                    <ul class="my-2">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.admin-users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="fw-semibold">Name</label>
                    <input type="text" name="name" class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control" required>
</div>


                <div class="mb-3">
                    <label class="fw-semibold">Email (User ID)</label>
                    <input type="email" name="email" class="form-control rounded-3" required>
                </div>

                <button class="btn btn-primary px-4 mt-2" type="submit">
                    <i class="bi bi-check2-circle"></i> Create User
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
