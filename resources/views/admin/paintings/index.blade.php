@extends('admin.layout')

@section('title', 'All Paintings')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">All Paintings</h2>

        <a href="{{ route('admin.paintings.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle"></i> Add Painting
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif


    <!-- Paintings Table -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th style="width: 120px;">Image</th>
                        <th>Title</th>
                        <th>Artist</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 250px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paintings as $painting)
                    <tr>
                        <td class="fw-bold">{{ $painting->id }}</td>

                        <td>
                            @if($painting->image)
                                <img src="{{ asset('uploads/paintings/'.$painting->image) }}" 
                                     class="img-thumbnail rounded" 
                                     style="height: 60px; width: 60px; object-fit: cover;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>

                        <td class="fw-semibold">{{ $painting->title }}</td>

                        <td>
                            @if($painting->artist)
                                <div class="mb-1">{{ $painting->artist->name }}</div>

                                <!-- About artist button (passes data to modal) -->
                                <button type="button"
                                    class="btn btn-sm btn-outline-primary artist-info-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#artistInfoModal"
                                    data-name="{{ htmlspecialchars($painting->artist->name, ENT_QUOTES) }}"
                                    data-email="{{ $painting->artist->email ?? '' }}"
                                    data-phone="{{ $painting->artist->phone ?? '' }}"
                                    data-bio="{{ htmlspecialchars($painting->artist->bio ?? 'No bio available.', ENT_QUOTES) }}"
                                    data-photo="{{ $painting->artist->photo ? asset('uploads/artists/'.$painting->artist->photo) : '' }}">
                                    <i class="bi bi-person-lines-fill"></i> About artist
                                </button>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td>
                            @if($painting->status === 'active')
                                <span class="badge bg-success px-3 py-2">Active</span>
                            @elseif($painting->status === 'inactive')
                                <span class="badge bg-warning text-dark px-3 py-2">Inactive</span>
                            @else
                                <span class="badge bg-danger px-3 py-2">Sold</span>
                            @endif
                        </td>

                       <td>
    <div class="d-flex gap-2">

        <!-- Edit -->
        <a href="{{ route('admin.paintings.edit', $painting) }}" 
            class="btn btn-sm btn-info d-flex align-items-center">
            <i class="bi bi-pencil-square"></i>
        </a>

        <!-- Delete -->
        <form action="{{ route('admin.paintings.destroy',$painting) }}" 
              method="POST"
              onsubmit="return confirm('Delete this painting?');">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger d-flex align-items-center">
                <i class="bi bi-trash"></i>
            </button>
        </form>

        <!-- Toggle Status -->
        <form action="{{ route('admin.paintings.toggleStatus',$painting) }}" 
              method="POST">
            @csrf
            <button class="btn btn-sm btn-secondary d-flex align-items-center">
                <i class="bi bi-shuffle"></i>
                {{ $painting->status == 'active' ? 'Deactivate' : 'Activate' }}
            </button>
        </form>

    </div>
</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $paintings->links() }}
    </div>

</div>

<!-- Artist Info Modal (single modal used for all rows) -->
<div class="modal fade" id="artistInfoModal" tabindex="-1" aria-labelledby="artistInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="artistInfoModalLabel">Artist Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-4 text-center">
                <img id="artist-photo" src="" alt="Artist Photo" class="img-fluid rounded" style="max-height:220px; object-fit:cover;">
            </div>
            <div class="col-md-8">
                <h4 id="artist-name" class="mb-1"></h4>
                <p class="mb-1"><strong>Email:</strong> <span id="artist-email" class="text-muted"></span></p>
                <p class="mb-1"><strong>Phone:</strong> <span id="artist-phone" class="text-muted"></span></p>
                <hr>
                <h6 class="mb-2">About</h6>
                <p id="artist-bio" class="small text-muted"></p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <a id="contact-artist-btn" href="#" class="btn btn-outline-primary d-none"><i class="bi bi-envelope"></i> Contact</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- JS to populate modal -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('artistInfoModal');

        // delegate clicks from buttons with class .artist-info-btn
        document.querySelectorAll('.artist-info-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const name = this.dataset.name || '—';
                const email = this.dataset.email || '';
                const phone = this.dataset.phone || '';
                const bio = this.dataset.bio || 'No bio available.';
                const photo = this.dataset.photo || '';

                // populate modal fields
                document.getElementById('artist-name').textContent = name;
                document.getElementById('artist-email').textContent = email || '—';
                document.getElementById('artist-phone').textContent = phone || '—';
                document.getElementById('artist-bio').textContent = bio;

                const photoEl = document.getElementById('artist-photo');
                if (photo) {
                    photoEl.src = photo;
                    photoEl.classList.remove('d-none');
                } else {
                    photoEl.src = '{{ asset("images/default-artist.png") }}'; // optional placeholder
                }

                // contact button
                const contactBtn = document.getElementById('contact-artist-btn');
                if (email) {
                    contactBtn.href = 'mailto:' + email;
                    contactBtn.classList.remove('d-none');
                } else {
                    contactBtn.classList.add('d-none');
                }

                // show modal using Bootstrap's Modal API (handled by data-bs-toggle already)
                // but ensure image has loaded gracefully
            });
        });
    });
</script>
@endpush

@endsection
