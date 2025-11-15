<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<style>
    /* Fix overlapping dropdown issue */
.header {
    position: relative;
    z-index: 9999 !important;
}

.notification-dropdown,
.dropdown {
    position: absolute;
    z-index: 99999 !important;
}



body {
    margin: 0;
    background: #f4f5f9;
    font-family: "Poppins", sans-serif;
}

/* Layout wrapper */
.wrapper {
    display: flex;
    
}
.sidebar {
    min-height: 100%;
    height: auto;
}


/* Sidebar */
.sidebar {
    width: 250px;
    background: #ffffff;
    border-right: 1px solid #ddd;
    padding: 20px 15px;
    transition: all 0.3s ease;
}

.sidebar.closed {
    width: 0;
    padding: 0;
    overflow: hidden;
}

.sidebar img.logo {
    width: 170px;
    margin-bottom: 25px;
}

/* Sidebar Title */
.sidebar-title {
    font-size: 12px;
    font-weight: 600;
    color: #8c8c8c;
    margin-bottom: 8px;
}

/* Sidebar Menu */
.sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #e6732c;
    font-size: 15px;
    padding: 10px;
    border-radius: 6px;
    text-decoration: none;
    margin-bottom: 5px;
    transition: 0.3s;
}

.sidebar-menu a:hover {
    background: #fff3e8;
}

/* Main content area */
.main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Header */
.header {
    height: 70px;
    background: #ffffff;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    gap: 20px;
}

/* Toggle button */
.toggle-btn {
    background: #f4f4f4;
    padding: 10px 12px;
    border-radius: 50%;
    cursor: pointer;
    border: none;
    transition: 0.3s;
}
.toggle-btn:hover {
    background: #ececec;
}

/* Header right section */
.header-right {
    display: flex;
    align-items: center;
    gap: 20px;
}

.icon-btn {
    background: #f4f4f4;
    padding: 10px;
    border-radius: 50%;
    cursor: pointer;
    transition: 0.3s;
}
.icon-btn:hover {
    background: #ececec;
}

/* Profile box */
.profile-box {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    position: relative;
}

.profile-box img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.profile-name {
    font-size: 14px;
    font-weight: 600;
    color: #333;
}

.profile-role {
    font-size: 12px;
    color: #888;
}

/* Dropdown */
.dropdown {
    position: absolute;
    right: 0;
    top: 55px;
    background: #fff;
    width: 160px;
    border-radius: 8px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.2);
    display: none;
    overflow: hidden;
}

.dropdown a {
    display: block;
    padding: 12px 15px;
    color: #333;
    font-size: 14px;
    text-decoration: none;
    border-bottom: 1px solid #eee;
}

.dropdown a:hover {
    background: #f7f7f7;
}

/* Page content */
.page-content {
    padding: 10px;
    background: #f4f5f9;
    height: calc(100% - 70px);
}
/* Notification dropdown */
.notification-dropdown {
    position: absolute;
    right: 60px;
    top: 65px;
    background: #fff;
    width: 260px;
    border-radius: 10px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.2);
    display: none;
    overflow: hidden;
    z-index: 10;
}

.notification-dropdown .notif-title {
    font-weight: 600;
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
}

.notif-item {
    display: block;
    padding: 12px 15px;
    font-size: 14px;
    border-bottom: 1px solid #f2f2f2;
    cursor: pointer;
}

.notif-item:hover {
    background: #f8f8f8;
}

.notification-count {
    position: absolute;
    top: 2px;
    right: 2px;
    padding: 3px 6px;
    font-size: 10px;
}

/* 🌙 Dark Mode Theme */
body.dark-mode {
    background: #1e1e1e;
    color: white !important;
}

.dark-mode .header,
.dark-mode .sidebar,
.dark-mode .page-content {
    background: #2a2a2a !important;
    color: white !important;
}

.dark-mode .sidebar-menu a {
    color: #ffb36b !important;
}

.dark-mode .sidebar-menu a:hover {
    background: #3e3e3e !important;
}

.dark-mode .dropdown,
.dark-mode .notification-dropdown {
    background: #2a2a2a;
    color: white;
}

.dark-mode table {
    color: white;
}

.dark-mode .card {
    background: #2f2f2f !important;
}
/* ⭐ Modern Sidebar Collapse */
.sidebar.collapsed {
    width: 75px;
    transition: 0.3s ease;
    padding: 20px 8px;
    overflow: hidden;
}
.sidebar.collapsed .sidebar-menu a span {
    display: none;
}
.sidebar.collapsed .sidebar-menu a {
    justify-content: center;
}
.sidebar.collapsed .logo {
    width: 50px;
    margin-left: 5px;
}

/* ⭐ Premium Toggle Button */
.modern-toggle {
    border-radius: 8px;
    background: #f4f4f4;
}
.modern-toggle:hover {
    background: #e6e6e6;
}

/* ⭐ Search Bar Modern */
.search-container {
    position: relative;
    max-width: 430px;
    width: 100%;
}
.search-input {
    
    width: 100%;
    padding: 10px 40px;
    border-radius: 50px;
    border: 1px solid #ddd;
    background: #f4f4f4;
    font-size: 14px;
    transition: 0.3s;
}
.search-input:focus {
    background: #ffffff;
    border-color: #e6732c;
    box-shadow: 0 0 8px rgba(230,115,44,0.4);
}
.search-icon {
    position: absolute;
    top: 11px;
    left: 15px;
    color: #666;
    font-size: 14px;
}

.search-suggestions {
    position: absolute;
    width: 100%;
    background: white;
    border-radius: 10px;
    border: 1px solid #eee;
    display: none;
    max-height: 200px;
    overflow-y: auto;
    z-index: 30;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.search-suggestions p {
    padding: 10px;
    margin: 0;
    cursor: pointer;
}
.search-suggestions p:hover {
    background: #f4f4f4;
}

/* ⭐ Modern Dropdown Animation */
.animated-dropdown {
    transform-origin: top right;
    transform: scale(0.8);
    opacity: 0;
    transition: 0.2s ease;
}
.animated-dropdown.show {
    display: block !important;
    transform: scale(1);
    opacity: 1;
}

/* ⭐ Modern Profile Hover */
.modern-profile:hover {
    background: #f2f2f2;
    border-radius: 10px;
    padding: 5px 10px;
}

</style>

</head>

<body>

<div class="wrapper">

    <!-- LEFT MENU -->
    <div class="sidebar" id="sidebar">
        <img src="{{ asset('uploads/users/artgallery.png') }}" class="logo" alt="Logo">

        <div class="sidebar-title">MAIN</div>

    <div class="sidebar-menu">

    <a href="{{ route('admin_dashboard') }}">
        <i class="fa fa-gauge"></i> <span>Dashboard</span>
    </a>

    <a href="{{ route('admin.admin-users.index') }}">
        <i class="fa fa-users"></i> <span>Users</span>
    </a>

    <a href="{{ route('admin.artists.index') }}">
        <i class="fa fa-user"></i> <span>Artists</span>
    </a>

    <a href="{{ route('admin.paintings.index') }}">
        <i class="fa fa-paintbrush"></i> <span>Paintings</span>
    </a>

    <a href="{{ route('admin.categories.index') }}">
        <i class="fa fa-layer-group"></i> <span>Categories</span>
    </a>

    <a href="{{ route('admin.galleries.index') }}">
        <i class="fa fa-building"></i> <span>Galleries</span>
    </a>


    <a href="{{ route('admin.blogs.index') }}">
    <i class="fa fa-blog"></i> <span>Blog</span>
</a>


    <a href="#">
        <i class="fa fa-calendar-days"></i> <span>Events</span>
    </a>

   

    <a href="#">
        <i class="fa fa-envelope"></i> <span>Enquiries</span>
    </a>

    <a href="#">
        <i class="fa fa-chart-line"></i> <span>Analytics</span>
    </a>

    <a href="#">
        <i class="fa fa-gear"></i> <span>Settings</span>
    </a>

</div>

    </div>

    <!-- RIGHT MAIN CONTENT -->
    <div class="main-content">

       <div class="header shadow-sm" style="backdrop-filter: blur(6px); background: rgba(255,255,255,0.80);">

    <!-- Sidebar Toggle -->
    <button class="toggle-btn modern-toggle" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars-staggered"></i>
    </button>

    <!-- Search Bar -->
    <div class="search-container">
        <i class="fa fa-search search-icon"></i>
        <input type="text" id="globalSearch" class="search-input"
            placeholder="Search users, paintings, artists, categories...">
        <div class="search-suggestions" id="searchSuggestions"></div>
    </div>

    <div class="header-right">

        <!-- Notifications -->
        <div class="icon-btn position-relative notif-btn" onclick="toggleNotification()">
            <i class="fa-solid fa-bell"></i>
            <span class="badge bg-danger notification-count">5</span>
        </div>

        <!-- Notification Dropdown -->
        <div class="notification-dropdown animated-dropdown" id="notificationDropdown">
            <p class="notif-title">Notifications</p>
            <a class="notif-item"><i class="fa fa-image"></i> New painting added</a>
            <a class="notif-item"><i class="fa fa-user-plus"></i> New artist onboarded</a>
            <a class="notif-item"><i class="fa fa-comment"></i> New enquiry received</a>
        </div>

        <!-- Profile -->
        <div class="profile-box modern-profile" onclick="toggleProfileMenu()">

            <img src="{{ asset('uploads/users/' . Auth::guard('admin')->user()->photo) }}" alt="Profile">

            <div>
                <div class="profile-name">{{ Auth::guard('admin')->user()->name }}</div>
                <div class="profile-role">Admin</div>
            </div>

            <div class="dropdown animated-dropdown" id="profileDropdown">
                <a href="{{ route('admin_profile') }}"><i class="fa fa-user"></i> Profile</a>
                <a href="{{ route('admin_logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>

    </div>
</div>


        <!-- CONTENT -->
        <div class="page-content">
    @yield('content')
</div>


    </div>

</div>

<script>

function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("collapsed");
}


// Profile dropdown
function toggleProfileMenu() {
    const dd = document.getElementById("profileDropdown");
    dd.style.display = dd.style.display === "block" ? "none" : "block";
}

// Close dropdown when clicking outside
window.addEventListener("click", function(e) {
    if (!e.target.closest(".profile-box")) {
        document.getElementById("profileDropdown").style.display = "none";
    }
});

</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    changePainting();
    setInterval(changePainting, 3000);
});
</script>
    
<script>
function toggleProfileMenu() {
    const dd = document.getElementById("profileDropdown");
    dd.classList.toggle("show");
}

function toggleNotification() {
    const dd = document.getElementById("notificationDropdown");
    dd.classList.toggle("show");
}
document.getElementById("globalSearch").addEventListener("input", function () {
    let v = this.value.trim();
    let box = document.getElementById("searchSuggestions");

    if (v.length < 1) {
        box.style.display = "none";
        return;
    }

    box.innerHTML = `
        <p>Search “${v}” in Paintings</p>
        <p>Search “${v}” in Artists</p>
        <p>Search “${v}” in Categories</p>
        <p>Search “${v}” in Users</p>
    `;
    box.style.display = "block";
});


// CLOSE DROPDOWNS WHEN CLICK OUTSIDE
window.addEventListener("click", function(e) {
    if (!e.target.closest(".profile-box")) {
        document.getElementById("profileDropdown").style.display = "none";
    }
    if (!e.target.closest(".icon-btn")) {
        document.getElementById("notificationDropdown").style.display = "none";
    }
});

// DARK / LIGHT MODE
function toggleTheme() {
    document.body.classList.toggle("dark-mode");

    // Save to localStorage
    if(document.body.classList.contains("dark-mode")) {
        localStorage.setItem("theme", "dark");
        document.getElementById("themeIcon").className = "fa-solid fa-sun";
    } else {
        localStorage.setItem("theme", "light");
        document.getElementById("themeIcon").className = "fa-solid fa-moon";
    }
}

// LOAD THEME ON PAGE LOAD
window.onload = function() {
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark-mode");
        document.getElementById("themeIcon").className = "fa-solid fa-sun";
    }
};
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


@stack('scripts')

</body>
</html>
