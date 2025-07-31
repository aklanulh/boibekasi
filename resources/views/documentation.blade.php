@extends('layouts.app')

@section('title', 'Dokumentasi - BOI Bekasi')

@section('content')
<!-- Header Section -->
<section class="hero-section py-5">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="text-success">Dokumentasi</span>
            </h1>
            <p class="lead">Galeri foto dan video kegiatan BOI Bekasi</p>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5>Filter berdasarkan jenis event:</h5>
            </div>
            <div class="col-md-6">
                <select class="form-select" id="eventFilter">
                    @foreach($eventTypes as $type)
                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Documentation Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4" id="documentationGrid">
            @foreach($documentations as $doc)
            <div class="col-lg-4 col-md-6 documentation-card" data-event-type="{{ $doc['type'] }}">
                <div class="card h-100 shadow-sm">
                    <div class="position-relative">
                        <img src="{{ $doc['image'] }}" 
                             class="card-img-top" 
                             alt="{{ $doc['title'] }}"
                             style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            @php
                                $typeColors = [
                                    'touring' => 'success',
                                    'event' => 'primary',
                                    'sunmori' => 'secondary',
                                    'baksos' => 'warning',
                                    'workshop' => 'info'
                                ];
                                $color = $typeColors[$doc['type']] ?? 'primary';
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ ucfirst($doc['type']) }}</span>
                        </div>
                        <div class="position-absolute bottom-0 start-0 m-3">
                            <button class="btn btn-light btn-sm rounded-circle" onclick="viewGallery('{{ $doc['title'] }}')">
                                <i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $doc['title'] }}</h5>
                        <p class="card-text text-muted">{{ $doc['description'] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ date('d M Y', strtotime($doc['date'])) }}
                            </small>
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-success btn-sm" onclick="shareEvent('{{ $doc['title'] }}')">
                                    <i class="fas fa-share"></i>
                                </button>
                                <button class="btn btn-outline-success btn-sm" onclick="downloadImage('{{ $doc['image'] }}')">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Documentation Count -->
        <div class="text-center mt-5">
            <div class="bg-success text-white rounded-3 d-inline-block px-4 py-3">
                <h5 class="mb-0">
                    <i class="fas fa-images me-2"></i>
                    Total Dokumentasi: <span id="docCount">{{ count($documentations) }}</span>
                </h5>
            </div>
        </div>
    </div>
</section>

<!-- Video Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="text-center mb-5">Video Highlight</h3>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="position-relative">
                        <img src="https://via.placeholder.com/400x225/22c55e/ffffff?text=VIDEO+TOURING" 
                             class="card-img-top" alt="Video Touring"
                             style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <button class="btn btn-success btn-lg rounded-circle" onclick="playVideo('touring')">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Touring Highlight 2024</h6>
                        <small class="text-muted">Kompilasi touring terbaik tahun 2024</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="position-relative">
                        <img src="https://via.placeholder.com/400x225/22c55e/ffffff?text=VIDEO+KOPDAR" 
                             class="card-img-top" alt="Video Kopdar"
                             style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <button class="btn btn-success btn-lg rounded-circle" onclick="playVideo('kopdar')">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Anniversary BOI Bekasi</h6>
                        <small class="text-muted">Perayaan anniversary ke-3 BOI Bekasi</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="position-relative">
                        <img src="https://via.placeholder.com/400x225/22c55e/ffffff?text=VIDEO+BAKSOS" 
                             class="card-img-top" alt="Video Baksos"
                             style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <button class="btn btn-success btn-lg rounded-circle" onclick="playVideo('baksos')">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Kegiatan Sosial</h6>
                        <small class="text-muted">Dokumentasi kegiatan bakti sosial</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5">
    <div class="container">
        <h3 class="text-center mb-5">Statistik Kegiatan</h3>
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="bg-success text-white rounded-3 p-4">
                    <i class="fas fa-camera fa-2x mb-3"></i>
                    <h3 class="fw-bold">500+</h3>
                    <p class="mb-0">Foto Dokumentasi</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="bg-primary text-white rounded-3 p-4">
                    <i class="fas fa-video fa-2x mb-3"></i>
                    <h3 class="fw-bold">50+</h3>
                    <p class="mb-0">Video Kegiatan</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="bg-warning text-dark rounded-3 p-4">
                    <i class="fas fa-route fa-2x mb-3"></i>
                    <h3 class="fw-bold">25+</h3>
                    <p class="mb-0">Destinasi Touring</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="bg-info text-white rounded-3 p-4">
                    <i class="fas fa-heart fa-2x mb-3"></i>
                    <h3 class="fw-bold">15+</h3>
                    <p class="mb-0">Kegiatan Sosial</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upload Section -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="mb-4">Punya Foto/Video Kegiatan?</h3>
                <p class="lead mb-4">
                    Bagikan dokumentasi kegiatan Anda dengan mengirimkannya kepada admin. 
                    Foto/video terbaik akan ditampilkan di galeri resmi BOI Bekasi.
                </p>
                <a href="https://wa.me/6281234567890?text=Halo%20BOI%20Bekasi,%20saya%20ingin%20mengirim%20dokumentasi%20kegiatan" 
                   class="whatsapp-btn" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Kirim Dokumentasi
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const eventFilter = document.getElementById('eventFilter');
    const docCards = document.querySelectorAll('.documentation-card');
    const docCount = document.getElementById('docCount');
    
    eventFilter.addEventListener('change', function() {
        const selectedType = this.value;
        let visibleCount = 0;
        
        docCards.forEach(card => {
            const cardType = card.getAttribute('data-event-type');
            
            if (selectedType === 'Semua Event' || cardType === selectedType) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        docCount.textContent = visibleCount;
    });
});

function viewGallery(title) {
    alert('Membuka galeri untuk: ' + title);
    // Implement gallery modal here
}

function shareEvent(title) {
    if (navigator.share) {
        navigator.share({
            title: 'BOI Bekasi - ' + title,
            text: 'Lihat dokumentasi kegiatan ' + title + ' BOI Bekasi',
            url: window.location.href
        });
    } else {
        // Fallback for browsers that don't support Web Share API
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('Link berhasil disalin ke clipboard!');
        });
    }
}

function downloadImage(imageUrl) {
    const link = document.createElement('a');
    link.href = imageUrl;
    link.download = 'boi-bekasi-documentation.jpg';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function playVideo(type) {
    alert('Memutar video ' + type);
    // Implement video player here
}
</script>
@endsection
