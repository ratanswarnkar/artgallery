@extends('admin.layout')

@section('title', 'Admin Users')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Admin Users</h2>
        <a href="{{ route('admin.admin-users.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-person-plus"></i> Add New
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 90px;">User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th style="width: 100px;">Status</th>
                        <th style="width: 250px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                    <tr>
                        <td><span class="fw-bold">{{ $admin->id }}</span></td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            <span class="badge bg-{{ $admin->status === 'active' ? 'success' : 'danger' }} px-3 py-2">
                                {{ ucfirst($admin->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.admin-users.edit', $admin->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <a href="{{ route('admin.admin-users.toggle-status', $admin->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="bi bi-shuffle"></i> Block
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.admin-users.destroy', $admin->id) }}"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" 
                                        class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No admin users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <div class="mt-3">
        {{ $admins->links() }}
    </div>

</div>
@endsection
