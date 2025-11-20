@extends('admin.layout')

@section('content')

<h2>Add New Painting</h2>

<form action="{{ route('admin.paintings.store') }}" method="POST" enctype="multipart/form-data"
      style="background:white;padding:25px;border-radius:10px;margin-top:20px;">
    @csrf

    <label>Title</label>
    <input type="text" name="title" required
           style="width:100%;padding:10px;margin:10px 0;border-radius:6px;border:1px solid #ccc;">

    <label>Artist</label>
    <select name="artist_id" style="width:100%;padding:10px;border-radius:6px;border:1px solid #ccc;">
        <option value="">Select Artist</option>
        @foreach($artists as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
    </select>

    <label>Description</label>
    <textarea name="description" class="summernote"></textarea>

    <label>Price</label>
    <input type="number" step="0.01" name="price"
           style="width:100%;padding:10px;margin:10px 0;border-radius:6px;border:1px solid #ccc;">

    <label>Status</label>
    <select name="status" style="width:100%;padding:10px;border-radius:6px;border:1px solid #ccc;">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
        <option value="sold">Sold</option>
    </select>

    <label>Image</label>
    <input type="file" name="image" accept="image/*" id="imageInput"
           style="display:block;margin-top:10px;">

    <img id="previewImg" src="" style="width:120px;display:none;margin-top:10px;border-radius:6px;">

    <button type="submit"
            style="background:#e6732c;color:#fff;padding:10px 20px;border:none;border-radius:6px;margin-top:20px;cursor:pointer;">
        Save Painting
    </button>
</form>

<!-- Image Preview -->
<script>
document.getElementById('imageInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(!file) return;
    const img = document.getElementById('previewImg');
    img.src = URL.createObjectURL(file);
    img.style.display = 'block';
});
</script>

@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            placeholder: 'Enter painting description...',
            height: 250,
        });
    });
</script>
@endpush
