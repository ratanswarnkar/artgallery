@extends('admin.layout')

@section('content')

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

    <h2 class="mb-4 fw-bold">📊 Analytics Dashboard</h2>

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
@endsection
