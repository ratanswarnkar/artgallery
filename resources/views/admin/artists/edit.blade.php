@extends('admin.layout')

@section('content')

<h2>Edit Artist</h2>

@if(session('success'))
    <div style="color:green;margin-bottom:10px">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div style="color:red;margin-bottom:10px;">
        @foreach ($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.artists.update', $artist->id) }}" 
      method="POST" enctype="multipart/form-data"
      style="background:#ffffff;padding:20px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.1);max-width:600px;">

    @csrf
    @method('PUT')

    <label>Name</label>
    <input type="text" name="name" value="{{ $artist->name }}"
           style="width:100%;padding:10px;margin-bottom:15px;border:1px solid #ccc;border-radius:6px;" required>

    <label>Email</label>
    <input type="email" name="email" value="{{ $artist->email }}"
           style="width:100%;padding:10px;margin-bottom:15px;border:1px solid #ccc;border-radius:6px;">

<div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control" value="{{ $artist->username }}" required>
    @error('username') 
        <div class="text-danger">{{ $message }}</div> 
    @enderror
</div>


    <label>Phone</label>
    <input type="text" name="phone" value="{{ $artist->phone }}"
           style="width:100%;padding:10px;margin-bottom:15px;border:1px solid #ccc;border-radius:6px;">

    <label>Bio</label>
    <textarea name="bio"
              style="width:100%;padding:10px;margin-bottom:15px;border:1px solid #ccc;border-radius:6px;">{{ $artist->bio }}</textarea>

    <label>Existing Photo</label><br>
    @if($artist->photo)
        <img src="{{ asset('uploads/artists/'.$artist->photo) }}" 
             style="width:100px;height:auto;border-radius:6px;margin-bottom:10px;">
    @else
        No Image Uploaded
    @endif
    <br><br>

    <label>Change Photo</label>
    <input type="file" name="photo" style="margin-bottom:15px;">

    <button type="submit"
            style="background:#e6732c;color:#fff;padding:10px 20px;border:none;border-radius:6px;cursor:pointer;">
        Update Artist
    </button>

</form>

@endsection
