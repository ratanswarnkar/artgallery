@extends('admin.layout')

@section('title', 'Edit Category')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4">Edit Category</h2>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Slug</label>
            <input type="text" name="slug" value="{{ $category->slug }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

</div>
@endsection
