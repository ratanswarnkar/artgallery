<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artist Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef2f7;
            font-family: "Poppins", sans-serif;
        }
        .login-box {
            width: 400px;
            margin: 90px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        .login-box h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c73e6;
            font-weight: 700;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3>Artist Login</h3>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('artist.login_submit') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" required/>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required/>
        </div>

        <button class="btn btn-primary w-100" style="background:#2c73e6;border:none;">Login</button>
    </form>
</div>

</body>
</html>
