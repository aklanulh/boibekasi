@extends('layouts.admin')

@section('title', 'Edit Merchandise')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit me-2"></i>Edit Merchandise</h2>
    <a href="{{ route('admin.merchandise.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Informasi Merchandise</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.merchandise.update', $merchandise) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $merchandise->name) }}" 
                                       placeholder="Contoh: Kaos BOI Bekasi Official"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('category') is-invalid @enderror" 
                                        id="category" 
                                        name="category" 
                                        required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Pakaian" {{ old('category', $merchandise->category) == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                    <option value="Aksesoris" {{ old('category', $merchandise->category) == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                                    <option value="Stiker" {{ old('category', $merchandise->category) == 'Stiker' ? 'selected' : '' }}>Stiker</option>
                                    <option value="Tas" {{ old('category', $merchandise->category) == 'Tas' ? 'selected' : '' }}>Tas</option>
                                    <option value="Lainnya" {{ old('category', $merchandise->category) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Deskripsi detail produk merchandise..."
                                  required>{{ old('description', $merchandise->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           id="price" 
                                           name="price" 
                                           value="{{ old('price', $merchandise->price) }}" 
                                           placeholder="150000"
                                           min="0"
                                           required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('stock') is-invalid @enderror" 
                                       id="stock" 
                                       name="stock" 
                                       value="{{ old('stock', $merchandise->stock) }}" 
                                       placeholder="50"
                                       min="0"
                                       required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="active" {{ old('status', $merchandise->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status', $merchandise->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sizes" class="form-label">Ukuran Tersedia</label>
                                <input type="text" 
                                       class="form-control @error('sizes') is-invalid @enderror" 
                                       id="sizes" 
                                       name="sizes" 
                                       value="{{ old('sizes', $merchandise->sizes) }}" 
                                       placeholder="S, M, L, XL, XXL">
                                <small class="form-text text-muted">Pisahkan dengan koma jika ada beberapa ukuran</small>
                                @error('sizes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="colors" class="form-label">Warna Tersedia</label>
                                <input type="text" 
                                       class="form-control @error('colors') is-invalid @enderror" 
                                       id="colors" 
                                       name="colors" 
                                       value="{{ old('colors', $merchandise->colors) }}" 
                                       placeholder="Hitam, Hijau, Putih">
                                <small class="form-text text-muted">Pisahkan dengan koma jika ada beberapa warna</small>
                                @error('colors')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Produk</label>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               onchange="previewImage(this)">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Current Image -->
                        @if($merchandise->image)
                            <div class="mt-3">
                                <label class="form-label">Gambar Saat Ini:</label><br>
                                <img src="{{ asset('storage/' . $merchandise->image) }}" 
                                     alt="{{ $merchandise->name }}" 
                                     class="img-thumbnail" 
                                     style="max-width: 200px;"
                                     id="currentImage">
                            </div>
                        @endif
                        
                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <label class="form-label">Preview Gambar Baru:</label><br>
                            <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.merchandise.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Merchandise
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Produk</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Nama:</strong></td>
                        <td>{{ $merchandise->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kategori:</strong></td>
                        <td>{{ $merchandise->category }}</td>
                    </tr>
                    <tr>
                        <td><strong>Harga:</strong></td>
                        <td>Rp {{ number_format($merchandise->price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Stok:</strong></td>
                        <td>{{ $merchandise->stock }} pcs</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <span class="badge bg-{{ $merchandise->status == 'active' ? 'success' : 'secondary' }}">
                                {{ $merchandise->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Dibuat:</strong></td>
                        <td>{{ $merchandise->created_at->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Tips Edit</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <ul class="mb-0 small">
                        <li>Pastikan informasi yang diubah sudah benar</li>
                        <li>Kosongkan field gambar jika tidak ingin mengubah</li>
                        <li>Status nonaktif akan menyembunyikan produk dari website</li>
                        <li>Perubahan harga akan langsung terlihat di website</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    const currentImage = document.getElementById('currentImage');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
            if (currentImage) {
                currentImage.style.opacity = '0.5';
            }
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.style.display = 'none';
        if (currentImage) {
            currentImage.style.opacity = '1';
        }
    }
}
</script>
@endsection
