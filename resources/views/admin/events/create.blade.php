@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Add New Event</h4>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Back to Events</a>
    </div>

    <div class="card p-4">
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label>Event Date *</label>
                    <input type="date" name="event_date" class="form-control" value="{{ old('event_date') }}" required>
                    @error('event_date') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label>Event Time *</label>
                    <input type="time" name="event_time" class="form-control" value="{{ old('event_time') }}" required>
                    @error('event_time') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label>Location *</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                    @error('location') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label>Description *</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label>Image (optional)</label>
                <input type="file" name="image" class="form-control">
                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button class="btn btn-primary">Create Event</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <!-- jQuery + Summernote -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#description').summernote({
                height: 250,
                toolbar: [
                    ['font', ['bold','italic','underline','clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']]
                ]
            });
        });
    </script>
@endsection
