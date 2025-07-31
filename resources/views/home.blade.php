@extends('layouts.app')

@section('title', 'BOI Bekasi - Benelli Owner Indonesia Chapter Bekasi')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    <span class="text-success">BOI BEKASI</span><br>
                    Benelli Owner Indonesia
                </h1>
                <p class="lead mb-4">
                    Komunitas motor Benelli resmi di Bekasi. 
                    Bergabunglah dengan brotherhood yang solid dan penuh kekeluargaan.
                </p>
                <a href="https://wa.me/6281234567890?text=Halo%20BOI%20Bekasi,%20saya%20ingin%20bergabung%20menjadi%20member" 
                   class="whatsapp-btn me-3" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Join Brotherhood
                </a>
                <a href="{{ route('members') }}" class="btn btn-outline-success">
                    Lihat Member
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <img src=" {{ asset('benelli-logo.png') }}" 
                     alt="Benelli Logo" class="img-fluid rounded-3 shadow">
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Tentang BOI Bekasi</h2>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Brotherhood</h5>
                        <p class="card-text">
                            Komunitas yang solid dengan ikatan kekeluargaan yang kuat antar member.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-motorcycle fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Touring</h5>
                        <p class="card-text">
                            Kegiatan touring rutin ke berbagai destinasi menarik di Indonesia.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-heart fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Bakti Sosial</h5>
                        <p class="card-text">
                            Aktif dalam kegiatan sosial untuk membantu masyarakat yang membutuhkan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How to Join Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Cara Bergabung</h2>
                <p class="lead">Ikuti langkah mudah berikut untuk menjadi member BOI Bekasi</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3 text-center">
                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                     style="width: 60px; height: 60px;">
                    <span class="fw-bold fs-4">1</span>
                </div>
                <h5>Punya Motor Benelli</h5>
                <p>Memiliki motor Benelli dan surat lengkap</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                     style="width: 60px; height: 60px;">
                    <span class="fw-bold fs-4">2</span>
                </div>
                <h5>Kontak Admin</h5>
                <p>Hubungi admin melalui WhatsApp dengan klik tombol "Join Brotherhood"</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                     style="width: 60px; height: 60px;">
                    <span class="fw-bold fs-4">3</span>
                </div>
                <h5>Verifikasi Data</h5>
                <p>Kirim foto motor, Nama, Asal Tinggal, Nama Unit, dan alasan bergabung. untuk proses verifikasi</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                     style="width: 60px; height: 60px;">
                    <span class="fw-bold fs-4">4</span>
                </div>
                <h5>Welcome!</h5>
                <p>Selamat datang di keluarga besar BOI Bekasi!</p>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="https://wa.me/6281234567890?text=Halo%20BOI%20Bekasi,%20saya%20ingin%20bergabung%20menjadi%20member" 
               class="whatsapp-btn" target="_blank">
                <i class="fab fa-whatsapp"></i>
                Gabung Sekarang
            </a>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <h3 class="text-success fw-bold">150+</h3>
                <p>Member Aktif</p>
            </div>
            <div class="col-md-3">
                <h3 class="text-success fw-bold">50+</h3>
                <p>Touring Dilakukan</p>
            </div>
            <div class="col-md-3">
                <h3 class="text-success fw-bold">25+</h3>
                <p>Kegiatan Sosial</p>
            </div>
            <div class="col-md-3">
                <h3 class="text-success fw-bold">3</h3>
                <p>Tahun Berdiri</p>
            </div>
        </div>
    </div>
</section>

<!-- Latest Events Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Kegiatan Terbaru</h2>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-success">Kopdar Rutin</h5>
                        <p class="card-text">
                            <i class="fas fa-calendar me-2"></i>2 Agustus 2025<br>
                            <i class="fas fa-clock me-2"></i>19:00 WIB<br>
                            <i class="fas fa-map-marker-alt me-2"></i>Cafe Rider, Bekasi Timur
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-success">Touring Puncak</h5>
                        <p class="card-text">
                            <i class="fas fa-calendar me-2"></i>10 Agustus 2025<br>
                            <i class="fas fa-clock me-2"></i>06:00 WIB<br>
                            <i class="fas fa-map-marker-alt me-2"></i>Start: Bekasi - Finish: Puncak
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-success">Bakti Sosial</h5>
                        <p class="card-text">
                            <i class="fas fa-calendar me-2"></i>17 Agustus 2025<br>
                            <i class="fas fa-clock me-2"></i>08:00 WIB<br>
                            <i class="fas fa-map-marker-alt me-2"></i>Panti Asuhan Harapan
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('events') }}" class="btn btn-primary">Lihat Semua Kegiatan</a>
        </div>
    </div>
</section>
@endsection
