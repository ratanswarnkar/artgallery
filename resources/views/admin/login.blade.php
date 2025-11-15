
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    .login-container {
      display: flex;
      height: 100vh;
    }

    .login-left {
      width: 40%;
      background: #0d1b2a;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      padding: 40px;
    }

    .login-logo img {
      width: 180px;
      margin-bottom: 20px;
    }

    .login-title {
      font-size: 26px;
      font-weight: 600;
      margin-bottom: 30px;
    }

    .login-box {
      width: 100%;
      max-width: 350px;
    }

    .login-box table {
      width: 100%;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #33415c;
      background: #1b263b;
      color: white;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .login-box button {
      width: 100%;
      padding: 12px;
      background: #1a73e8;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 500;
      transition: 0.3s;
    }

    .login-box button:hover {
      background: #135cc8;
    }

    .login-box a {
      color: #76a9ff;
      font-size: 14px;
      text-decoration: none;
    }

    .login-box a:hover {
      text-decoration: underline;
    }

    .login-right {
      width: 60%;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
      /* placeholder image: change path below */
      background-image: url('https://images.unsplash.com/photo-1512540452972-baac55d40ef1?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fGFydCUyMGdhbGxlcnl8ZW58MHx8MHx8fDA%3D');
    }

    .login-footer {
      position: absolute;
      bottom: 20px;
      left: 20px;
      color: #000;
      font-size: 14px;
    }
  </style>
</head>

<body>

  <div class="login-container">

    <div class="login-left">
      <div class="login-logo">
        <img src="{{ asset('uploads/users/artgallery.png')}}" alt="Your Logo">
      </div>

      <div class="login-title">Sign In</div>

      @if($errors->any())
        @foreach($errors->all() as $error)
          <div style="color: #ff6b6b; margin-bottom: 10px;">{{ $error }}</div>
        @endforeach
      @endif

      @if(session('success'))
        <div style="color: #51cf66; margin-bottom: 10px;">{{ session('success') }}</div>
      @endif

      @if(session('error'))
        <div style="color: #ff6b6b; margin-bottom: 10px;">{{ session('error') }}</div>
      @endif

      <div class="login-box">
        <form action="{{ route('admin_login_submit') }}" method="post">
          @csrf

          <table>
            <tr>
              <td>
                <label>Email</label>
                <input type="text" name="email" placeholder="Email">
              </td>
            </tr>

            <tr>
              <td>
                <label>Password</label>
                <input type="password" name="password" placeholder="Password">
              </td>
            </tr>

            <tr>
              <td>
                <button type="submit"><i class="fa fa-sign-in"></i> Login</button>
                <div style="margin-top: 10px;">
                  <a href="{{ route('admin_forget_password') }}">Forgot Password?</a>
                </div>
              </td>
            </tr>
          </table>

        </form>
      </div>
    </div>

    <div class="login-right">
      <div class="login-footer">
        <strong>Your Company Name</strong><br>
        Copyright © 2025
      </div>
    </div>

  </div>

</body>
</html>
