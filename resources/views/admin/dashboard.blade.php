@extends('admin.layout')

@section('content')

<h2 style="margin-bottom:20px;">Admin Dashboard</h2>

<div style="
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
">

    <!-- Painting Box -->
    <a href="{{ route('admin.paintings.index') }}" style="text-decoration:none;color:inherit;">
        <div style="
            position:relative;
            background:url('https://images.unsplash.com/photo-1513364776144-60967b0f800f') center/cover no-repeat;
            padding:25px;
            border-radius:10px;
            height:160px;
            display:flex;
            flex-direction:column;
            justify-content:flex-end;
            color:white;
            overflow:hidden;
            box-shadow:0 0 15px rgba(0,0,0,0.2);
        ">
            <!-- Overlay -->
            <div style="
                position:absolute;
                top:0; left:0;
                width:100%; height:100%;
                background:linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.7));
            "></div>

            <div style="position:relative;">
                <h3>Paintings</h3>
                <p style="margin:0;font-size:18px;font-weight:600;">{{ $paintingCount }}</p>
            </div>
        </div>
    </a>

    <!-- Artist Box -->
    <a href="{{ route('admin.artists.index') }}" style="text-decoration:none;color:inherit;">
        <div style="
            position:relative;
            background:url('data:image/jpeg;base64,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') center/cover no-repeat;
            padding:25px;
            border-radius:10px;
            height:160px;
            display:flex;
            flex-direction:column;
            justify-content:flex-end;
            color:white;
            overflow:hidden;
            box-shadow:0 0 15px rgba(0,0,0,0.2);
        ">
            <!-- Overlay -->
            <div style="
                position:absolute;
                top:0; left:0;
                width:100%; height:100%;
                background:linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.7));
            "></div>

            <div style="position:relative;">
                <h3>Artists</h3>
                <p style="margin:0;font-size:18px;font-weight:600;">{{ $artistCount }}</p>
            </div>
        </div>
    </a>

    <!-- Branch Box -->
    <a href="{{ route('admin.admin-users.index') }}" style="text-decoration:none;color:inherit;">

        <div style="
            position:relative;
            background:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXvR_ZQQMbyETS2br0FzbqbBMqOKobtTZzzQ&s') center/cover no-repeat; 
            padding:25px;
            border-radius:10px;
            height:160px;
            display:flex;
            flex-direction:column;
            justify-content:flex-end;
            color:white;
            overflow:hidden;
            box-shadow:0 0 15px rgba(0,0,0,0.2);
        ">
            <!-- Overlay -->
            <div style="
                position:absolute;
                top:0; left:0;
                width:100%; height:100%;
                background:linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.7));
            "></div>

            <div style="position:relative;">
                <h3>Users</h3>
                <p style="margin:0;font-size:18px;font-weight:600;">{{ $admin_usersCount }}</p>
            </div>
        </div>
    </a>

</div>

<!-- FULL WIDTH GRAPH BOX -->
<div style="
    width:100%;
    margin-top:40px;
    background:#ffffffdd;
    backdrop-filter:blur(10px);
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
">

    <h3 style="margin-bottom:15px;color:#e6732c;font-weight:600;">
        Visitors Analytics
    </h3>

    <div style="width:100%;overflow:hidden;">

        <!-- Animated Graph -->
        <svg viewBox="0 0 1200 200" style="width:100%; height:220px;">

            <defs>
                <linearGradient id="gradOrange" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#ffb57a" />
                    <stop offset="100%" stop-color="#e6732c" />
                </linearGradient>
            </defs>

            <!-- BACK WAVE -->
            <path id="wave"
                d="M0 140 Q300 60 600 120 T1200 140 V200 H0 Z"
                fill="url(#gradOrange)"
                opacity="0.35">
                
                <animate attributeName="d" dur="6s" repeatCount="indefinite"
                    values="
                    M0 140 Q300 60 600 120 T1200 140 V200 H0 Z;
                    M0 130 Q320 40 620 100 T1200 130 V200 H0 Z;
                    M0 140 Q300 60 600 120 T1200 140 V200 H0 Z;
                    ">
                </animate>

            </path>

            <!-- FRONT LINE -->
            <path id="line"
                d="M0 140 Q300 60 600 120 T1200 140"
                stroke="#e6732c"
                stroke-width="6"
                fill="none">
                
                <animate attributeName="d" dur="6s" repeatCount="indefinite"
                    values="
                    M0 140 Q300 60 600 120 T1200 140;
                    M0 130 Q320 40 620 100 T1200 130;
                    M0 140 Q300 60 600 120 T1200 140;
                    ">
                </animate>
            </path>

            <!-- FLOAT DOTS -->
            <circle cx="600" cy="120" r="8" fill="white" stroke="#e6732c" stroke-width="4">
                <animate attributeName="cy" dur="6s" repeatCount="indefinite" values="120;100;120" />
            </circle>

            <circle cx="900" cy="130" r="8" fill="white" stroke="#e6732c" stroke-width="4">
                <animate attributeName="cy" dur="6s" repeatCount="indefinite" values="130;150;130" />
            </circle>

        </svg>


        
    </div>
  <!-- Painting Slider -->
<div style="
    width:100%;
    margin-top:40px;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
">
    <div id="paintingSlider"></div>
</div>

<style>
#paintingSlider {
    width: 100%;
    height: 350px !important;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    animation: fadeSlide 1s ease-in-out;
}

@keyframes fadeSlide {
    from { opacity:0; }
    to   { opacity:1; }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const paintings = [
        "{{ asset('uploads/users/1.png')}}",
        "{{ asset('uploads/users/2.png')}}",
        "{{ asset('uploads/users/3.png')}}"
    ];

    let index = 0;

    function changePainting() {
        const slider = document.getElementById("paintingSlider");
        slider.style.animation = "none";
        void slider.offsetWidth;
        slider.style.animation = "fadeSlide 1s ease-in-out";
        slider.style.backgroundImage = `url('${paintings[index]}')`;
        index = (index + 1) % paintings.length;
    }

    changePainting();
    setInterval(changePainting, 3000);

});
</script>

<style>
.analytics-cards .card {
    border-radius: 14px;
    border: none;
    padding: 22px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: .3s;
}
.analytics-cards .card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}
.chart-card {
    border-radius: 16px;
    padding: 18px;
}
.section-title {
    font-weight: 600;
    font-size: 20px;
}
</style>

<div class="container-fluid">

    <!-- <h2 class="mb-4 fw-bold">📊 Analytics Dashboard</h2> -->

    <br><br>

    {{-- Top Stats Cards --}}
    <div class="row analytics-cards mb-4">

        <div class="col-md-3">
            <div class="card text-center bg-primary text-white">
                <h5>Total Visitors</h5>
                <h2 class="fw-bold">12,540</h2>
                <small>+8% this month</small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center bg-success text-white">
                <h5>Page Views</h5>
                <h2 class="fw-bold">45,220</h2>
                <small>+12% this month</small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center bg-warning text-white">
                <h5>Blog Reads</h5>
                <h2 class="fw-bold">9,341</h2>
                <small>Top blog engagement</small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center bg-danger text-white">
                <h5>Bounce Rate</h5>
                <h2 class="fw-bold">28%</h2>
                <small>-5% improvement</small>
            </div>
        </div>

    </div>

    {{-- Charts Row 1 --}}
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card chart-card">
                <h5 class="section-title mb-3">Visitors Overview</h5>
                <canvas id="visitorsChart" height="140"></canvas>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card chart-card">
                <h5 class="section-title mb-3">Traffic Sources</h5>
                <canvas id="trafficChart" height="140"></canvas>
            </div>
        </div>
    </div>

    {{-- Charts Row 2 --}}
    <div class="row">
        <div class="col-md-7 mb-4">
            <div class="card chart-card">
                <h5 class="section-title mb-3">Blog Category Performance</h5>
                <canvas id="categoryChart" height="140"></canvas>
            </div>
        </div>

        <div class="col-md-5 mb-4">
            <div class="card chart-card">
                <h5 class="section-title mb-3">Device Usage</h5>
                <canvas id="deviceChart" height="140"></canvas>
            </div>
        </div>
    </div>

</div>

@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Visitors Chart
const visitorsCtx = document.getElementById('visitorsChart');
new Chart(visitorsCtx, {
    type: 'line',
    data: {
        labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
        datasets: [{
            label: 'Visitors',
            data: [1200, 1350, 1420, 1600, 1750, 1900, 2080],
            borderColor: '#1e90ff',
            backgroundColor: 'rgba(30,144,255,0.3)',
            borderWidth: 3,
            tension: 0.4,
            fill: true
        }]
    }
});

// Traffic Pie
new Chart(document.getElementById('trafficChart'), {
    type: 'pie',
    data: {
        labels: ['Google','Direct','Social Media','Referral'],
        datasets: [{
            data: [58,22,14,6],
            backgroundColor: ['#1e90ff','#28a745','#ffb400','#dc3545'],
        }]
    }
});

// Blog Category
new Chart(document.getElementById('categoryChart'), {
    type: 'bar',
    data: {
        labels: ['Painting','Sculpture','Photography','Art Events','News'],
        datasets: [{
            label: 'Reads',
            data: [3200,2100,1800,2600,1900],
            backgroundColor: '#6f42c1'
        }]
    }
});

// Device Usage
new Chart(document.getElementById('deviceChart'), {
    type: 'doughnut',
    data: {
        labels: ['Mobile','Desktop','Tablet'],
        datasets: [{
            data: [62,28,10],
            backgroundColor: ['#ff6384','#36a2eb','#ffcd56'],
        }]
    }
});
</script>

</div>


@endsection


