<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AdminUserCredentialsMail;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function index()
    {
        $admins = AdminUser::orderBy('id','desc')->paginate(15);
        return view('admin.admin_users.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin_users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admin_users,username',
            'email'    => 'required|email|unique:admin_users,email',
        ]);

        // Generate random password
        $password = Str::random(10);
        $data['password'] = Hash::make($password);

        // Create admin user
        $admin = AdminUser::create($data);

        // Send login details via email
        Mail::to($admin->email)->send(new AdminUserCredentialsMail($admin, $password));

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success','Admin user created and email sent with credentials.');
    }

    public function edit(AdminUser $admin_user)
    {
        return view('admin.admin_users.edit', compact('admin_user'));
    }

    public function update(Request $request, AdminUser $admin_user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admin_users,username,' . $admin_user->id,
            'email'    => 'required|email|unique:admin_users,email,' . $admin_user->id,
            'password' => 'nullable|string|min:6',
            'status'   => 'nullable|in:active,inactive',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $admin_user->update($data);

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success','Admin user updated successfully.');
    }

    public function destroy(AdminUser $admin_user)
    {
        $admin_user->delete();
        return redirect()
            ->route('admin.admin-users.index')
            ->with('success','Admin user deleted.');
    }

    public function toggleStatus(AdminUser $admin_user)
    {
        $admin_user->status = $admin_user->status === 'active' ? 'inactive' : 'active';
        $admin_user->save();

        return back()->with('success','Admin status updated.');
    }
}
