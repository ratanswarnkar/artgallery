@extends('admin.layout')

@section('content')

<h2 style="margin-bottom:20px;">Admin Dashboard</h2>

<div style="
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
">

    <!-- Painting Box -->
    <a href="javascript:void(0);" style="text-decoration:none;color:inherit;">
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
    <a href="javascript:void(0);" style="text-decoration:none;color:inherit;">
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
                <h3>Events</h3>
                <p style="margin:0;font-size:18px;font-weight:600;">{{ $branchCount }}</p>
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
        "https://upload.wikimedia.org/wikipedia/commons/6/6a/Mona_Lisa.jpg",
        "https://upload.wikimedia.org/wikipedia/commons/d/d7/Meisje_met_de_parel.jpg",
        "https://upload.wikimedia.org/wikipedia/commons/f/f4/The_Scream.jpg"
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



</div>


@endsection
