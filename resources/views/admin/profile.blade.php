@extends('admin.layout')

@section('content')

<h1 style="margin-bottom:20px;">Admin Profile Page</h1>

@if($errors->any())
    <div style="color:red; margin-bottom:10px;">
        @foreach($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
    </div>
@endif

@if(session('success'))
    <div style="color:green; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="color:red; margin-bottom:10px;">
        {{ session('error') }}
    </div>
@endif


<form action="{{ route('admin_profile_submit') }}" method="post" enctype="multipart/form-data"
      style="background:#ffffff;padding:20px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.1);max-width:600px;">
    @csrf 

    <table style="width:100%; border-collapse:collapse;">
        
        <tr>
            <td style="padding:10px; font-weight:600;">Existing Photo:</td>
            <td style="padding:10px;">
                @if(Auth::guard('admin')->user()->photo == null)
                    No Photo Found
                @else
                    <img src="{{ asset('uploads/users/'.Auth::guard('admin')->user()->photo) }}" 
                         style="width:100px;height:auto;border-radius:8px;">
                @endif 
            </td>
        </tr>

        <tr>
            <td style="padding:10px; font-weight:600;">Change Photo:</td>
            <td style="padding:10px;">
                <input type="file" name="photo">
            </td>
        </tr>

        <tr>
            <td style="padding:10px; font-weight:600;">Name:</td>
            <td style="padding:10px;">
                <input type="text" name="name" 
                       value="{{ Auth::guard('admin')->user()->name }}"
                       style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
            </td>
        </tr>

        <tr>
            <td style="padding:10px; font-weight:600;">Email:</td>
            <td style="padding:10px;">
                <input type="text" name="email" 
                       value="{{ Auth::guard('admin')->user()->email }}"
                       style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
            </td>
        </tr>

        <tr>
            <td style="padding:10px; font-weight:600;">Password:</td>
            <td style="padding:10px;">
                <input type="password" name="password" placeholder="Password"
                       style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
            </td>
        </tr>

        <tr>
            <td style="padding:10px; font-weight:600;">Confirm Password:</td>
            <td style="padding:10px;">
                <input type="password" name="confirm_password" placeholder="Confirm Password"
                       style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
            </td>
        </tr>

        <tr>
            <td></td>
            <td style="padding:10px;">
                <button type="submit" 
                        style="background:#e6732c;color:#fff;padding:10px 20px;border:none;border-radius:6px;cursor:pointer;">
                    Update
                </button>
            </td>
        </tr>

    </table>

</form>

@endsection
