@extends('admin.layout')

@section('content')

<h2>Edit Painting</h2>

<form action="{{ route('admin.paintings.update',$painting) }}" method="POST" enctype="multipart/form-data"
      style="background:white;padding:25px;border-radius:10px;margin-top:20px;">
    @csrf
    @method('PUT')

    <label>Title</label>
    <input type="text" name="title" value="{{ $painting->title }}" required
           style="width:100%;padding:10px;margin:10px 0;border-radius:6px;border:1px solid #ccc;">

    <label>Artist</label>
    <select name="artist_id" style="width:100%;padding:10px;border-radius:6px;border:1px solid #ccc;">
        <option value="">Select Artist</option>
        @foreach($artists as $id => $name)
            <option value="{{ $id }}" {{ $painting->artist_id == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>

    <label>Description</label>
    <textarea name="description" rows="4"
              style="width:100%;padding:10px;margin:10px 0;border-radius:6px;border:1px solid #ccc;">{{ $painting->description }}</textarea>

    <label>Price</label>
    <input type="number" step="0.01" name="price" value="{{ $painting->price }}"
           style="width:100%;padding:10px;margin:10px 0;border-radius:6px;border:1px solid #ccc;">

    <label>Status</label>
    <select name="status" style="width:100%;padding:10px;border-radius:6px;border:1px solid #ccc;">
        <option value="active"   {{ $painting->status == 'active' ? 'selected':'' }}>Active</option>
        <option value="inactive" {{ $painting->status == 'inactive' ? 'selected':'' }}>Inactive</option>
        <option value="sold"     {{ $painting->status == 'sold' ? 'selected':'' }}>Sold</option>
    </select>

    <label>Current Image</label><br>
    @if($painting->image)
        <img src="{{ asset('storage/'.$painting->image) }}"
             style="width:120px;border-radius:6px;margin-top:10px;">
    @else
        <p>No Image</p>
    @endif

    <label style="margin-top:20px;">Change Image</label>
    <input type="file" name="image" accept="image/*" id="imageInput"
           style="display:block;margin-top:10px;">

    <img id="previewImg" style="width:120px;display:none;margin-top:10px;border-radius:6px;">

    <button type="submit"
            style="background:#e6732c;color:#fff;padding:10px 20px;border:none;border-radius:6px;margin-top:20px;cursor:pointer;">
        Update Painting
    </button>
</form>

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
