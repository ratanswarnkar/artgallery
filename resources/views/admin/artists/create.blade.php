@extends('admin.layout')

@section('content')

<h2>Create Artist</h2>

@if ($errors->any())
    <div style="color:red;margin-bottom:10px;">
        @foreach ($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
    </div>
@endif

@if(session('success'))
    <div style="color:green;margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.artists.store') }}" method="POST" enctype="multipart/form-data"
      style="background:#ffffff;padding:20px;border-radius:10px;
             box-shadow:0 0 10px rgba(0,0,0,0.1);max-width:600px;">

    @csrf

    <label>Name</label>
    <input type="text" name="name" required
           style="width:100%;padding:10px;margin-bottom:15px;
                  border:1px solid #ccc;border-radius:6px;">

    <label>Email</label>
    <input type="email" name="email"
           style="width:100%;padding:10px;margin-bottom:15px;
                  border:1px solid #ccc;border-radius:6px;">

<div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control" required>
    @error('username') 
        <div class="text-danger">{{ $message }}</div> 
    @enderror
</div>


    <label>Phone</label>
    <input type="text" name="phone"
           style="width:100%;padding:10px;margin-bottom:15px;
                  border:1px solid #ccc;border-radius:6px;">

    <label>Bio</label>
    <textarea name="bio"
              style="width:100%;padding:10px;margin-bottom:15px;
                     border:1px solid #ccc;border-radius:6px;"></textarea>

    <label>Photo</label>
    <input type="file" name="photo"
           style="margin-bottom:15px;">

    <button type="submit"
            style="background:#e6732c;color:#fff;padding:10px 20px;
                   border:none;border-radius:6px;cursor:pointer;">
        Save Artist
    </button>

</form>

@endsection
