@extends('layouts.app')

@section('title', 'Coming Soon - ' . $page . ' | BOI Bekasi')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-lg-8 col-md-10">
            <div class="text-center">
                <!-- Coming Soon Icon -->
                <div class="coming-soon-main-icon mb-4">
                    <i class="fas fa-cog fa-spin" style="font-size: 6rem; color: var(--secondary-color);"></i>
                </div>
                
                <!-- Main Title -->
                <h1 class="display-4 fw-bold mb-3" style="color: var(--primary-color);">
                    Coming Soon
                </h1>
                
                <!-- Page Name -->
                <h2 class="h3 mb-4" style="color: var(--secondary-color);">
                    Halaman {{ $page }} Sedang Dalam Pengembangan
                </h2>
                
                <!-- Description -->
                <p class="lead text-muted mb-5">
                    Kami sedang bekerja keras untuk menghadirkan fitur terbaik untuk komunitas BOI Bekasi. 
                    Halaman ini akan segera tersedia dengan konten yang menarik dan bermanfaat.
                </p>
                
                <!-- Features Coming Soon -->
                <div class="row mb-5">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-rocket mb-3" style="font-size: 2.5rem; color: var(--secondary-color);"></i>
                                <h5>Fitur Modern</h5>
                                <p class="text-muted small">Interface yang user-friendly dan responsif</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-users mb-3" style="font-size: 2.5rem; color: var(--secondary-color);"></i>
                                <h5>Komunitas</h5>
                                <p class="text-muted small">Konten yang dibuat khusus untuk member BOI</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-mobile-alt mb-3" style="font-size: 2.5rem; color: var(--secondary-color);"></i>
                                <h5>Mobile Ready</h5>
                                <p class="text-muted small">Akses mudah dari berbagai perangkat</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Call to Action -->
                <div class="alert alert-info d-inline-block mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Sementara itu,</strong> Anda dapat mengakses <strong>Kalender Kegiatan</strong> untuk melihat event-event terbaru BOI Bekasi.
                </div>
                
                <!-- Action Buttons -->
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="{{ route('events') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-calendar-alt me-2"></i>Lihat Kalender Kegiatan
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20BOI%20Bekasi%2C%20saya%20ingin%20bergabung%20dengan%20komunitas" 
                       class="whatsapp-btn btn-lg" target="_blank">
                        <i class="fab fa-whatsapp me-2"></i>Gabung WhatsApp Group
                    </a>
                </div>
                
                <!-- Progress Indicator -->
                <div class="mt-5">
                    <p class="text-muted mb-2">Progress Pengembangan</p>
                    <div class="progress mx-auto" style="height: 8px; max-width: 300px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                             role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <small class="text-muted">75% Complete</small>
                </div>
                
                <!-- Back Navigation -->
                <div class="mt-4">
                    <button onclick="history.back()" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Add some interactive elements
    document.addEventListener('DOMContentLoaded', function() {
        // Animate the progress bar on load
        setTimeout(function() {
            const progressBar = document.querySelector('.progress-bar');
            if (progressBar) {
                progressBar.style.transition = 'width 2s ease-in-out';
            }
        }, 500);
        
        // Add hover effect to feature cards
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.transition = 'transform 0.3s ease';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection
@endsection
