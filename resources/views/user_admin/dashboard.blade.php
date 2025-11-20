@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Welcome Admin User</h2>

    <div class="alert alert-success mt-3">
        You are logged in as a Sub Admin.
    </div>

    <p class="mt-3">Use the sidebar to manage users, categories, paintings and more.</p>
</div>
@endsection

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin User Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* SAME STYLING AS YOUR ADMIN PANEL */
body {
    margin: 0;
    background: #f4f5f9;
    font-family: "Poppins", sans-serif;
}
.wrapper { display: flex; }
.sidebar {
    width: 250px;
    background: #ffffff;
    border-right: 1px solid #ddd;
    padding: 20px 15px;
    transition: 0.3s;
}
.sidebar img.logo { width: 170px; margin-bottom: 25px; }

.sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #e6732c;
    padding: 10px;
    font-size: 15px;
    border-radius: 6px;
    text-decoration: none;
    transition: 0.3s;
    margin-bottom: 5px;
}
.sidebar-menu a:hover { background: #fff3e8; }

.main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Header */
.header {
    height: 70px;
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(6px);
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

/* Profile Dropdown */
.profile-box { display: flex; align-items: center; gap: 10px; cursor: pointer; position: relative; }
.profile-box img { width: 40px; height: 40px; border-radius: 50%; }
.dropdown {
    position: absolute; top: 55px; right: 0;
    width: 160px; background: #fff;
    border-radius: 8px; display: none;
    box-shadow: 0 6px 18px rgba(0,0,0,0.2);
}
.dropdown a { display: block; padding: 12px; color: #333; border-bottom: 1px solid #eee; }
.dropdown a:hover { background: #f7f7f7; }

.page-content { padding: 20px; }
</style>
</head>

<body>

<div class="wrapper">

   
    <div class="sidebar" id="sidebar">
        <img src="{{ asset('uploads/users/artgallery.png') }}" class="logo" alt="Logo">

        <div class="sidebar-menu">
            
            <a href="{{ route('user_admin.dashboard') }}">
                <i class="fa fa-gauge"></i> <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.admin-users.index') }}">
                <i class="fa fa-users"></i> <span>Users</span>
            </a>

            <a href="{{ route('admin.galleries.index') }}">
                <i class="fa fa-building"></i> <span>Galleries</span>
            </a>

            <a href="{{ route('admin.blogs.index') }}">
                <i class="fa fa-blog"></i> <span>Blogs</span>
            </a>

            <a href="{{ route('admin.events.index') }}">
                <i class="fa fa-calendar-days"></i> <span>Events</span>
            </a>

            <a href="{{ route('admin.analytics') }}">
                <i class="fa fa-chart-line"></i> <span>Analytics</span>
            </a>

        </div>
    </div>

    
    <div class="main-content">

        
        <div class="header shadow-sm">

            <button onclick="document.getElementById('sidebar').classList.toggle('collapsed')" class="btn btn-light">
                <i class="fa fa-bars"></i>
            </button>

            <div></div> 

            <div class="profile-box" onclick="toggleProfileDropdown()">
                <img src="{{ asset('uploads/users/' . Auth::guard('user_admin')->user()->photo) }}" alt="Profile">

                <div>
                    <div class="fw-bold">{{ Auth::guard('user_admin')->user()->name }}</div>
                    <div style="font-size: 12px; color: #777;">Admin User</div>
                </div>

                <div class="dropdown" id="profileDropdown">
                    <a href="#"><i class="fa fa-user"></i> Profile</a>
                    <a href="{{ route('user_admin.logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </div>

        </div>

       
        <div class="page-content">
            @yield('content')
        </div>

    </div>

</div>

<script>
function toggleProfileDropdown() {
    const dd = document.getElementById('profileDropdown');
    dd.style.display = dd.style.display === 'block' ? 'none' : 'block';
}
window.addEventListener('click', e => {
    if (!e.target.closest('.profile-box')) {
        document.getElementById('profileDropdown').style.display = 'none';
    }
});
</script>

</body>
</html> -->

