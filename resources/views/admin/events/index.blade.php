@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Events Management</h4>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">+ Add Event</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-3">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($event->image)
                            <img src="{{ asset('uploads/events/'.$event->image) }}"
                                 width="60" height="60" class="rounded">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $event->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}</td>
                    <td>{{ $event->location }}</td>
                    <td>
                        <form action="{{ route('admin.events.toggleStatus', $event->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm {{ $event->status == 'active' ? 'btn-success' : 'btn-secondary' }}">
                                {{ ucfirst($event->status) }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-info btn-sm">Edit</a>

                        <form action="{{ route('admin.events.destroy', $event->id) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this event?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No events found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection
