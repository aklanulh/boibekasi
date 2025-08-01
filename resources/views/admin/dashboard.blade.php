@extends('layouts.admin')

@section('title', 'Dashboard Admin - BOI Bekasi')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-3">Dashboard Admin BOI Bekasi</h1>
            <p class="text-muted">Selamat datang di panel admin BOI Bekasi. Kelola semua informasi komunitas dari sini.</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <i class="fas fa-users fa-2x mb-3"></i>
                <h3>{{ $stats['members'] }}</h3>
                <p class="mb-0">Total Member</p>
                <small>Aktif</small>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                <i class="fas fa-shopping-bag fa-2x mb-3"></i>
                <h3>{{ $stats['merchandises'] }}</h3>
                <p class="mb-0">Merchandise</p>
                <small>Tersedia</small>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <i class="fas fa-calendar fa-2x mb-3"></i>
                <h3>{{ $stats['events'] }}</h3>
                <p class="mb-0">Total Events</p>
                <small>Terdaftar</small>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                <i class="fas fa-images fa-2x mb-3"></i>
                <h3>{{ $stats['documentations'] }}</h3>
                <p class="mb-0">Dokumentasi</p>
                <small>Tersimpan</small>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Members -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-users me-2"></i>
                        Member Terbaru
                    </h5>
                    <span class="btn btn-sm btn-outline-secondary disabled">
                        Coming Soon
                    </span>
                </div>
                <div class="card-body p-0">
                    @if($recent_members->count() > 0)
                        @foreach($recent_members as $member)
                        <div class="d-flex align-items-center p-3 border-bottom">
                            <img src="{{ $member->photo ?? 'https://via.placeholder.com/40x40/22c55e/ffffff?text=' . substr($member->name, 0, 1) }}" 
                                 alt="{{ $member->name }}" 
                                 class="rounded-circle me-3"
                                 style="width: 40px; height: 40px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $member->name }}</h6>
                                <small class="text-muted">{{ $member->bike_type }}</small>
                            </div>
                            <span class="badge bg-success">{{ $member->status }}</span>
                        </div>
                        @endforeach
                    @else
                        <div class="p-3 text-center text-muted">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <p class="mb-0">Belum ada member terbaru</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar me-2"></i>
                        Event Mendatang
                    </h5>
                    <span class="btn btn-sm btn-outline-secondary disabled">
                        Coming Soon
                    </span>
                </div>
                <div class="card-body p-0">
                    @if($upcoming_events->count() > 0)
                        @foreach($upcoming_events as $event)
                        <div class="p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-1">{{ $event->title }}</h6>
                                @php
                                    $typeColors = [
                                        'kopdar' => 'primary',
                                        'touring' => 'success',
                                        'baksos' => 'warning',
                                        'workshop' => 'info',
                                        'sunmori' => 'secondary'
                                    ];
                                    $color = $typeColors[$event->type] ?? 'primary';
                                @endphp
                                <span class="badge bg-{{ $color }}">{{ ucfirst($event->type) }}</span>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ date('d M Y', strtotime($event->date)) }}
                                <br>
                                <i class="fas fa-clock me-1"></i>
                                {{ date('H:i', strtotime($event->time)) }} WIB
                            </small>
                        </div>
                        @endforeach
                    @else
                        <div class="p-3 text-center text-muted">
                            <i class="fas fa-calendar fa-2x mb-2"></i>
                            <p class="mb-0">Belum ada event mendatang</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Documentation -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-images me-2"></i>
                        Dokumentasi Terbaru
                    </h5>
                    <a href="{{ route('admin.documentation.index') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($recent_documentation->count() > 0)
                        @foreach($recent_documentation as $doc)
                        <div class="d-flex align-items-center p-3 border-bottom">
                            <img src="{{ $doc->image }}" 
                                 alt="{{ $doc->title }}" 
                                 class="rounded me-3"
                                 style="width: 50px; height: 40px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ Str::limit($doc->title, 25) }}</h6>
                                <small class="text-muted">
                                    {{ date('d M Y', strtotime($doc->date)) }} • {{ $doc->views }} views
                                </small>
                            </div>
                            @php
                                $typeColors = [
                                    'touring' => 'success',
                                    'event' => 'primary',
                                    'sunmori' => 'secondary',
                                    'baksos' => 'warning',
                                    'workshop' => 'info'
                                ];
                                $color = $typeColors[$doc->type] ?? 'primary';
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ ucfirst($doc->type) }}</span>
                        </div>
                        @endforeach
                    @else
                        <div class="p-3 text-center text-muted">
                            <i class="fas fa-images fa-2x mb-2"></i>
                            <p class="mb-0">Belum ada dokumentasi</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-3">
                            <a href="{{ route('admin.members.create') }}" class="btn btn-success w-100">
                                <i class="fas fa-user-plus me-2"></i>
                                Tambah Member
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <a href="{{ route('admin.merchandise.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-2"></i>
                                Tambah Merchandise
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <a href="{{ route('admin.events.create') }}" class="btn btn-warning w-100">
                                <i class="fas fa-calendar-plus me-2"></i>
                                Buat Event
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <a href="{{ route('admin.documentation.create') }}" class="btn btn-info w-100">
                                <i class="fas fa-camera me-2"></i>
                                Upload Dokumentasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
