<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BOI Bekasi - Benelli Owner Indonesia')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #000000;
            --secondary-color: #22c55e;
            --accent-color: #ffffff;
            --dark-bg: #1a1a1a;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--accent-color);
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-bg) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--secondary-color) !important;
        }
        
        .navbar-nav .nav-link {
            color: var(--accent-color) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--secondary-color) !important;
            transform: translateY(-2px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #16a34a 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(34, 197, 94, 0.4);
        }
        
        .btn-outline-success {
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-success:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-bg) 100%);
            color: var(--accent-color);
            padding: 100px 0;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .footer {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-bg) 100%);
            color: var(--accent-color);
            padding: 50px 0 20px;
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 30px;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }
        
        .whatsapp-btn {
            background: #25D366;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .whatsapp-btn:hover {
            background: #20b358;
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }
        
        .coming-soon {
            opacity: 0.7;
            cursor: not-allowed !important;
        }
        
        .coming-soon:hover {
            color: #ffc107 !important;
            transform: none !important;
        }
        
        .modal-content {
            border-radius: 15px;
            border: none;
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-bg) 100%);
            color: var(--accent-color);
            border-radius: 15px 15px 0 0;
        }
        
        .modal-body {
            padding: 30px;
            text-align: center;
        }
        
        .coming-soon-icon {
            font-size: 4rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-motorcycle me-2"></i>BOI BEKASI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link coming-soon" href="#" onclick="showComingSoon('Home'); return false;">
                            Home <small class="text-warning ms-1">(Coming Soon)</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link coming-soon" href="#" onclick="showComingSoon('Member Aktif'); return false;">
                            Member Aktif <small class="text-warning ms-1">(Coming Soon)</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link coming-soon" href="#" onclick="showComingSoon('Merchandise'); return false;">
                            Merchandise <small class="text-warning ms-1">(Coming Soon)</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events') }}">Kalender Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link coming-soon" href="#" onclick="showComingSoon('Dokumentasi'); return false;">
                            Dokumentasi <small class="text-warning ms-1">(Coming Soon)</small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="margin-top: 76px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-motorcycle me-2"></i>BOI BEKASI</h5>
                    <p>Benelli Owner Indonesia Chapter Bekasi - Komunitas Motor Benelli Terbesar di Bekasi</p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" onclick="showComingSoon('Home'); return false;" class="text-light text-decoration-none">Home <small class="text-warning">(Coming Soon)</small></a></li>
                        <li><a href="#" onclick="showComingSoon('Member Aktif'); return false;" class="text-light text-decoration-none">Member Aktif <small class="text-warning">(Coming Soon)</small></a></li>
                        <li><a href="#" onclick="showComingSoon('Merchandise'); return false;" class="text-light text-decoration-none">Merchandise <small class="text-warning">(Coming Soon)</small></a></li>
                        <li><a href="{{ route('events') }}" class="text-light text-decoration-none">Kegiatan</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Kontak</h6>
                    <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Bekasi, Jawa Barat</p>
                    <p class="mb-1"><i class="fas fa-phone me-2"></i>+62 812-3456-7890</p>
                    <p><i class="fas fa-envelope me-2"></i>info@boibekasi.com</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2025 BOI Bekasi. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Coming Soon Modal -->
    <div class="modal fade" id="comingSoonModal" tabindex="-1" aria-labelledby="comingSoonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="comingSoonModalLabel">
                        <i class="fas fa-tools me-2"></i>Coming Soon
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="coming-soon-icon">
                        <i class="fas fa-cog fa-spin"></i>
                    </div>
                    <h4 class="mb-3">Halaman <span id="pageName"></span> Sedang Dalam Pengembangan</h4>
                    <p class="text-muted mb-4">Kami sedang bekerja keras untuk menghadirkan fitur terbaik untuk Anda. Halaman ini akan segera tersedia!</p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Sementara itu, Anda dapat mengakses <strong>Kalender Kegiatan</strong> untuk melihat event-event terbaru BOI Bekasi.
                    </div>
                    <a href="{{ route('events') }}" class="btn btn-primary">
                        <i class="fas fa-calendar-alt me-2"></i>Lihat Kalender Kegiatan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showComingSoon(pageName) {
            document.getElementById('pageName').textContent = pageName;
            var modal = new bootstrap.Modal(document.getElementById('comingSoonModal'));
            modal.show();
        }
    </script>
    @yield('scripts')
</body>
</html>
