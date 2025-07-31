@extends('layouts.app')

@section('title', 'Member Aktif - BOI Bekasi')

@section('content')
<!-- Header Section -->
<section class="hero-section py-5">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="text-success">Member Aktif</span>
            </h1>
            <p class="lead">Keluarga besar BOI Bekasi yang solid dan kompak</p>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" id="memberSearch" 
                           placeholder="Cari berdasarkan nama atau NRP...">
                    <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <small class="text-muted mt-2 d-block text-center">
                    Ketik nama lengkap atau Nomor Registrasi Pokok (NRP) untuk mencari member
                </small>
            </div>
        </div>
    </div>
</section>

<!-- Members Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4" id="membersGrid">
            @foreach($members as $member)
            <div class="col-lg-4 col-md-6 member-card" 
                 data-name="{{ strtolower($member['name']) }}" 
                 data-nrp="{{ strtolower($member['nrp'] ?? '') }}">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <img src="{{ $member->photo_url ?? asset('images/default-member.svg') }}" 
                             alt="{{ $member['name'] }}" 
                             class="rounded-circle mb-3"
                             style="width: 120px; height: 120px; object-fit: cover;"
                             onerror="this.src='{{ asset('images/default-member.svg') }}'">
                        <h5 class="card-title fw-bold">{{ $member['name'] }}</h5>
                        @if($member['nrp'])
                            <p class="text-primary fw-semibold mb-2">
                                <i class="fas fa-id-card me-2"></i>NRP: {{ $member['nrp'] }}
                            </p>
                        @endif
                        <p class="text-success fw-semibold mb-2">
                            <i class="fas fa-motorcycle me-2"></i>{{ $member['bike_type'] }}
                        </p>
                        <p class="text-muted small">
                            <i class="fas fa-calendar me-2"></i>Bergabung: {{ date('d M Y', strtotime($member['join_date'])) }}
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-success">Member Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Member Count -->
        <div class="text-center mt-5">
            <div class="bg-success text-white rounded-3 d-inline-block px-4 py-3">
                <h4 class="mb-0">
                    <i class="fas fa-users me-2"></i>
                    Total Member: <span id="memberCount">{{ count($members) }}</span>
                </h4>
            </div>
        </div>
    </div>
</section>

<!-- Join Us Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="mb-4">Ingin Bergabung dengan Keluarga BOI Bekasi?</h3>
                <p class="lead mb-4">
                    Jadilah bagian dari komunitas motor Benelli terbesar di Bekasi. 
                    Nikmati kebersamaan, touring seru, dan berbagai kegiatan menarik lainnya!
                </p>
                <a href="https://wa.me/6281234567890?text=Halo%20BOI%20Bekasi,%20saya%20ingin%20bergabung%20menjadi%20member" 
                   class="whatsapp-btn me-3" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Join Brotherhood
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-success">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('memberSearch');
    const clearButton = document.getElementById('clearSearch');
    const memberCards = document.querySelectorAll('.member-card');
    const memberCount = document.getElementById('memberCount');
    
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;
        
        memberCards.forEach(card => {
            const memberName = card.getAttribute('data-name');
            const memberNrp = card.getAttribute('data-nrp');
            
            // Check if search term matches name or NRP
            const nameMatch = memberName.includes(searchTerm);
            const nrpMatch = memberNrp.includes(searchTerm);
            
            if (searchTerm === '' || nameMatch || nrpMatch) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        memberCount.textContent = visibleCount;
        
        // Show "no results" message if needed
        const noResults = document.getElementById('noResults');
        if (visibleCount === 0 && searchTerm !== '') {
            if (!noResults) {
                const noResultsDiv = document.createElement('div');
                noResultsDiv.id = 'noResults';
                noResultsDiv.className = 'col-12 text-center py-5';
                noResultsDiv.innerHTML = `
                    <div class="text-muted">
                        <i class="fas fa-search fa-3x mb-3"></i>
                        <h5>Tidak ada member yang ditemukan</h5>
                        <p>Coba gunakan kata kunci yang berbeda</p>
                    </div>
                `;
                document.getElementById('membersGrid').appendChild(noResultsDiv);
            }
        } else if (noResults) {
            noResults.remove();
        }
    }
    
    // Search as user types (debounced)
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 300);
    });
    
    // Clear search
    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        performSearch();
        searchInput.focus();
    });
    
    // Enter key search
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            clearTimeout(searchTimeout);
            performSearch();
        }
    });
});
</script>
@endsection
