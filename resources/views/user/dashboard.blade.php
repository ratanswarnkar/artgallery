@include('user.top')
<h1>Dashboard Page</h1>
<p>
    Welcome {{ Auth::guard('web')->user()->name }} to your dashboard
</p>
