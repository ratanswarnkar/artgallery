@extends('admin.layout')

@section('content')

<style>
/* Table styling */
.table-box {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

/* Header Row */
.table-box h2 {
    margin: 0;
    font-size: 22px;
    font-weight: 600;
}

/* Buttons */
.btn-orange {
    background: #e6732c;
    color: #fff !important;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
}
.btn-orange:hover {
    background: #c45f22;
}

/* Table */
.table-custom {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}
.table-custom th {
    background: #000;
    color: #fff;
    padding: 10px;
    font-size: 14px;
}
.table-custom td {
    padding: 10px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

/* Status Badge */
.badge-active {
    background: #28a745;
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 13px;
}
.badge-blocked {
    background: #dc3545;
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 13px;
}

/* Action Buttons */
.action-btn {
    padding: 6px 10px;
    margin-right: 6px;
    border-radius: 5px;
    font-size: 12px;
    cursor: pointer;
    border: none;
    transition: 0.2s;
}

.btn-edit { background: #007bff; color:white; }
.btn-edit:hover { background:#0056b3; }

.btn-delete { background:#dc3545; color:white; }
.btn-delete:hover { background:#a71d2a; }

.btn-toggle { background:#6c757d; color:white; }
.btn-toggle:hover { background:#4b5054; }

</style>

<div class="table-box">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <h2>All Artists</h2>
        <a href="{{ route('admin.artists.create') }}" class="btn-orange">+ Create Artist</a>
    </div>

    @if(session('success'))
        <div style="padding:10px;background:#d4edda;color:#155724;border-radius:6px;margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-custom">
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Username</th>   <!-- ⭐ Added Column -->
                <th>Email</th>
                <th>Status</th>
                <th style="text-align:left;">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($artists as $artist)
            <tr>
                <td>{{ $artist->id }}</td>

                <td>
                    @if($artist->photo)
                    <img src="{{ asset('uploads/artists/'.$artist->photo) }}" 
                         style="width:60px;height:60px;border-radius:8px;object-fit:cover;">
                    @endif
                </td>

                <td>{{ $artist->name }}</td>

                <!-- ⭐ Username Display -->
                <td>{{ $artist->username }}</td>

                <td>{{ $artist->email }}</td>

                <td>
                    @if($artist->status == 'active')
                        <span class="badge-active">Active</span>
                    @else
                        <span class="badge-blocked">Blocked</span>
                    @endif
                </td>

                <td>

                    <!-- Edit -->
                    <a href="{{ route('admin.artists.edit', $artist) }}" 
                       class="action-btn btn-edit">
                        Edit
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('admin.artists.destroy', $artist) }}" 
                          method="POST" style="display:inline-block;"
                          onsubmit="return confirm('Are you sure to delete this artist?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-delete">
                            Delete
                        </button>
                    </form>

                    <!-- Block / Unblock -->
                    <form action="{{ route('admin.artists.toggleStatus', $artist) }}"
                          method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="action-btn btn-toggle">
                            {{ $artist->status === 'active' ? 'Block' : 'Unblock' }}
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:15px;">
        {{ $artists->links() }}
    </div>

</div>

@endsection
