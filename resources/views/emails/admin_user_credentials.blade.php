@component('mail::message')
# Welcome, {{ $admin->name }}!

Your admin account has been created successfully.

---

## 🔐 Login Credentials  
**User ID:** {{ $admin->email }} 
**Password:** {{ $password }}

---

## 🔗 Login URL  
@component('mail::button', ['url' => url('/admin/login')])
Login to Admin Panel
@endcomponent

---

### 📌 Important Note  
After logging in, please change your password immediately to secure your account.

If you have any issues, reply to this email.

Thanks,  
**Art Gallery Admin Team**
@endcomponent
