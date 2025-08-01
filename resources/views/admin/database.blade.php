@extends('layouts.admin')

@section('title', 'Database Info - Admin Panel')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-3">
                <i class="fas fa-database me-2"></i>
                Database Information
            </h1>
            <p class="text-muted">View database tables and record counts.</p>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-table me-2"></i>
                        Database Tables
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Table Name</th>
                                    <th>Record Count</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tableInfo as $table)
                                    <tr>
                                        <td>
                                            <i class="fas fa-table me-2 text-primary"></i>
                                            {{ $table['name'] }}
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ number_format($table['count']) }}</span>
                                        </td>
                                        <td>
                                            @if($table['count'] > 0)
                                                <span class="badge bg-success">Has Data</span>
                                            @else
                                                <span class="badge bg-warning">Empty</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            No tables found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-tools me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-grid">
                                <a href="{{ route('admin.tinker') }}" class="btn btn-primary">
                                    <i class="fas fa-terminal me-2"></i>
                                    Open Tinker
                                </a>
                            </div>
                            <small class="text-muted">Execute PHP code to interact with database</small>
                        </div>
                        <div class="col-md-4">
                            <div class="d-grid">
                                <button class="btn btn-info" onclick="refreshPage()">
                                    <i class="fas fa-sync-alt me-2"></i>
                                    Refresh Data
                                </button>
                            </div>
                            <small class="text-muted">Reload table information</small>
                        </div>
                        <div class="col-md-4">
                            <div class="d-grid">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Back to Dashboard
                                </a>
                            </div>
                            <small class="text-muted">Return to main dashboard</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function refreshPage() {
    window.location.reload();
}
</script>
@endsection
