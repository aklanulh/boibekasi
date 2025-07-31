@extends('layouts.app')

@section('title', 'Merchandise - BOI Bekasi')

@section('content')
<!-- Header Section -->
<section class="hero-section py-5">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="text-success">Merchandise</span>
            </h1>
            <p class="lead">Produk resmi BOI Bekasi dengan kualitas terbaik</p>
        </div>
    </div>
</section>

<!-- Merchandise Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @foreach($merchandise as $item)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" 
                             class="card-img-top" 
                             alt="{{ $item->name }}"
                             style="height: 250px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/400x250/22c55e/ffffff?text={{ urlencode($item->name) }}" 
                             class="card-img-top" 
                             alt="{{ $item->name }}"
                             style="height: 250px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold mb-0">{{ $item->name }}</h5>
                            <span class="badge bg-primary">{{ ucfirst($item->category) }}</span>
                        </div>
                        <p class="card-text text-muted flex-grow-1">{{ $item->description }}</p>
                        
                        @if($item->sizes)
                            <div class="mb-2">
                                <small class="text-muted"><strong>Ukuran:</strong> {{ $item->sizes }}</small>
                            </div>
                        @endif
                        
                        @if($item->colors)
                            <div class="mb-2">
                                <small class="text-muted"><strong>Warna:</strong> {{ $item->colors }}</small>
                            </div>
                        @endif
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-success fw-bold mb-0">Rp {{ number_format($item->price, 0, ',', '.') }}</h4>
                                @if($item->stock > 0)
                                    <span class="badge bg-success">Stok: {{ $item->stock }}</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </div>
                            @if($item->stock > 0)
                                <a href="https://wa.me/6281234567890?text=Halo%20BOI%20Bekasi,%20saya%20ingin%20memesan%20{{ urlencode($item->name) }}%20dengan%20harga%20Rp%20{{ number_format($item->price, 0, ',', '.') }}" 
                                   class="whatsapp-btn w-100 text-center" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                    Pesan via WhatsApp
                                </a>
                            @else
                                <button class="btn btn-secondary w-100" disabled>
                                    <i class="fas fa-times"></i>
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Info Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h3 class="mb-4">Informasi Pemesanan</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="bg-white rounded-3 p-4 h-100">
                            <i class="fas fa-shipping-fast fa-2x text-success mb-3"></i>
                            <h5>Pengiriman</h5>
                            <p class="mb-0">Gratis ongkir untuk wilayah Bekasi</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white rounded-3 p-4 h-100">
                            <i class="fas fa-credit-card fa-2x text-success mb-3"></i>
                            <h5>Pembayaran</h5>
                            <p class="mb-0">Transfer Bank / E-Wallet / COD</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white rounded-3 p-4 h-100">
                            <i class="fas fa-medal fa-2x text-success mb-3"></i>
                            <h5>Kualitas</h5>
                            <p class="mb-0">Produk berkualitas tinggi dan tahan lama</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Size Guide Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="text-center mb-4">Panduan Ukuran</h3>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Ukuran Kaos</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Lebar (cm)</th>
                                            <th>Panjang (cm)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>S</td><td>48</td><td>68</td></tr>
                                        <tr><td>M</td><td>52</td><td>70</td></tr>
                                        <tr><td>L</td><td>56</td><td>72</td></tr>
                                        <tr><td>XL</td><td>60</td><td>74</td></tr>
                                        <tr><td>XXL</td><td>64</td><td>76</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Ukuran Jaket</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Lebar (cm)</th>
                                            <th>Panjang (cm)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>S</td><td>50</td><td>65</td></tr>
                                        <tr><td>M</td><td>54</td><td>67</td></tr>
                                        <tr><td>L</td><td>58</td><td>69</td></tr>
                                        <tr><td>XL</td><td>62</td><td>71</td></tr>
                                        <tr><td>XXL</td><td>66</td><td>73</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="mb-4">Butuh Bantuan?</h3>
                <p class="lead mb-4">
                    Tim customer service kami siap membantu Anda 24/7 untuk pertanyaan seputar produk dan pemesanan.
                </p>
                <a href="https://wa.me/6281234567890?text=Halo%20BOI%20Bekasi,%20saya%20butuh%20bantuan%20untuk%20pemesanan%20merchandise" 
                   class="whatsapp-btn" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Hubungi Customer Service
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
