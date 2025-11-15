<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject ?? 'Email Notification' }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #111; padding: 40px; color: #f5f5f5;">

    <div style="max-width: 600px; margin: 0 auto; background-color: #000; border: 2px solid #d4af37; border-radius: 12px; box-shadow: 0 0 10px rgba(212,175,55,0.5); padding: 30px;">

        <h2 style="color: #d4af37; text-align: center; margin-bottom: 30px;">
            {{ $subject }}
        </h2>

        <div style="font-size: 16px; line-height: 1.7; color: #f5f5f5; text-align: center;">
            {!! $body !!}
        </div>

        <p style="margin-top: 40px; text-align: center; color: #aaa; font-size: 14px;">
            If you didn’t request this action, you can safely ignore this email.
        </p>
    </div>

    <p style="text-align: center; color: #777; margin-top: 20px; font-size: 13px;">
        © {{ date('Y') }} Your Company Name. All rights reserved.
    </p>

</body>
</html>
