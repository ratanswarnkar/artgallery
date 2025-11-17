@extends('admin.layout')

@section('title', 'Create Category')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Create Category</h2>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Slug</label>
            <input type="text" name="slug" class="form-control" placeholder="Auto or Manual">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-success">Create</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
