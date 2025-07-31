@extends('layouts.admin')

@section('title', 'Kelola Events')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-calendar-alt me-2"></i>Kelola Events</h2>
    <a href="{{ route('admin.events.create') }}" class="btn btn-success">
        <i class="fas fa-plus me-2"></i>Tambah Event
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Event</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Peserta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" 
                                             alt="{{ $event->title }}" 
                                             class="img-thumbnail me-3" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary d-flex align-items-center justify-content-center me-3" 
                                             style="width: 50px; height: 50px; border-radius: 8px;">
                                            <i class="fas fa-calendar text-white"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $event->title }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($event->description, 40) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $event->time }}</small>
                                </div>
                            </td>
                            <td>
                                <small>{{ Str::limit($event->location, 30) }}</small>
                            </td>
                            <td>
                                @php
                                    $typeColors = [
                                        'meetup' => 'primary',
                                        'touring' => 'success',
                                        'charity' => 'warning',
                                        'workshop' => 'info',
                                        'gathering' => 'secondary'
                                    ];
                                    $typeLabels = [
                                        'meetup' => 'Meetup',
                                        'touring' => 'Touring',
                                        'charity' => 'Charity',
                                        'workshop' => 'Workshop',
                                        'gathering' => 'Gathering'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $typeColors[$event->type] ?? 'secondary' }}">
                                    {{ $typeLabels[$event->type] ?? ucfirst($event->type) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'draft' => 'secondary',
                                        'published' => 'success',
                                        'cancelled' => 'danger',
                                        'completed' => 'primary'
                                    ];
                                    $statusLabels = [
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'cancelled' => 'Cancelled',
                                        'completed' => 'Completed'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$event->status] ?? 'secondary' }}">
                                    {{ $statusLabels[$event->status] ?? ucfirst($event->status) }}
                                </span>
                            </td>
                            <td>
                                @if($event->max_participants)
                                    <span class="badge bg-info">Max: {{ $event->max_participants }}</span>
                                @else
                                    <span class="text-muted">Unlimited</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.events.show', $event->id) }}" 
                                       class="btn btn-sm btn-info" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.events.edit', $event->id) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-danger" 
                                            title="Hapus"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $event->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $event->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus event <strong>{{ $event->title }}</strong>?</p>
                                                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                    <p>Belum ada event yang ditambahkan.</p>
                                    <a href="{{ route('admin.events.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus me-2"></i>Tambah Event Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($events->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Events</h6>
                        <h3>{{ $events->total() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Published</h6>
                        <h3>{{ $events->where('status', 'published')->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Draft</h6>
                        <h3>{{ $events->where('status', 'draft')->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-edit fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Completed</h6>
                        <h3>{{ $events->where('status', 'completed')->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-trophy fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
