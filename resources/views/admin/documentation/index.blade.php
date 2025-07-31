@extends('layouts.admin')

@section('title', 'Kelola Dokumentasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-camera me-2"></i>Kelola Dokumentasi</h2>
    <a href="{{ route('admin.documentation.create') }}" class="btn btn-success">
        <i class="fas fa-plus me-2"></i>Tambah Dokumentasi
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
                        <th>Media</th>
                        <th>Judul</th>
                        <th>Tipe</th>
                        <th>Event</th>
                        <th>Tanggal</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documentations as $doc)
                        <tr>
                            <td>
                                @if($doc->image)
                                    <img src="{{ asset('storage/' . $doc->image) }}" 
                                         alt="{{ $doc->title }}" 
                                         class="img-thumbnail" 
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px; border-radius: 8px;">
                                        @if($doc->type === 'video')
                                            <i class="fas fa-video text-white"></i>
                                        @else
                                            <i class="fas fa-image text-white"></i>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $doc->title }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($doc->description, 40) }}</small>
                                    @if($doc->photographer)
                                        <br>
                                        <small class="text-info">
                                            <i class="fas fa-user-camera me-1"></i>
                                            {{ $doc->photographer }}
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($doc->type === 'photo')
                                    <span class="badge bg-primary">
                                        <i class="fas fa-image me-1"></i>Photo
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-video me-1"></i>Video
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($doc->event)
                                    <span class="badge bg-info">{{ Str::limit($doc->event->title, 20) }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ \Carbon\Carbon::parse($doc->date)->format('d M Y') }}</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-eye me-1"></i>
                                    {{ number_format($doc->views) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'draft' => 'secondary',
                                        'published' => 'success',
                                        'archived' => 'warning'
                                    ];
                                    $statusLabels = [
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'archived' => 'Archived'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$doc->status] ?? 'secondary' }}">
                                    {{ $statusLabels[$doc->status] ?? ucfirst($doc->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.documentation.show', $doc->id) }}" 
                                       class="btn btn-sm btn-info" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.documentation.edit', $doc->id) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-danger" 
                                            title="Hapus"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $doc->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $doc->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus dokumentasi <strong>{{ $doc->title }}</strong>?</p>
                                                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.documentation.destroy', $doc->id) }}" method="POST" style="display: inline;">
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
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-camera-retro fa-3x mb-3"></i>
                                    <p>Belum ada dokumentasi yang ditambahkan.</p>
                                    <a href="{{ route('admin.documentation.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus me-2"></i>Tambah Dokumentasi Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($documentations->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $documentations->links() }}
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
                        <h6>Total Dokumentasi</h6>
                        <h3>{{ $documentations->total() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-camera fa-2x"></i>
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
                        <h3>{{ $documentations->where('status', 'published')->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-eye fa-2x"></i>
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
                        <h6>Photos</h6>
                        <h3>{{ $documentations->where('type', 'photo')->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-image fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Videos</h6>
                        <h3>{{ $documentations->where('type', 'video')->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-video fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
