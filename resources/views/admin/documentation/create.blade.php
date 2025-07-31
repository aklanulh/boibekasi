@extends('layouts.admin')

@section('title', 'Tambah Dokumentasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus me-2"></i>Tambah Dokumentasi</h2>
    <a href="{{ route('admin.documentation.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Dokumentasi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.documentation.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Dokumentasi <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title') }}" 
                                       placeholder="Contoh: Touring Puncak Bogor 2024"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="type" class="form-label">Tipe Media <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" 
                                        id="type" 
                                        name="type" 
                                        required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="photo" {{ old('type') == 'photo' ? 'selected' : '' }}>Photo</option>
                                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                                </select>
                                @error('type')
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
                                  placeholder="Deskripsi detail dokumentasi..."
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" 
                                       class="form-control @error('date') is-invalid @enderror" 
                                       id="date" 
                                       name="date" 
                                       value="{{ old('date') }}" 
                                       required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="event_id" class="form-label">Event Terkait</label>
                                <select class="form-select @error('event_id') is-invalid @enderror" 
                                        id="event_id" 
                                        name="event_id">
                                    <option value="">Pilih Event (Opsional)</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                            {{ $event->title }} - {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('event_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="photographer" class="form-label">Photographer/Videographer</label>
                                <input type="text" 
                                       class="form-control @error('photographer') is-invalid @enderror" 
                                       id="photographer" 
                                       name="photographer" 
                                       value="{{ old('photographer') }}" 
                                       placeholder="Nama photographer">
                                @error('photographer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" 
                               class="form-control @error('tags') is-invalid @enderror" 
                               id="tags" 
                               name="tags" 
                               value="{{ old('tags') }}" 
                               placeholder="touring, meetup, charity (pisahkan dengan koma)">
                        <small class="form-text text-muted">Pisahkan dengan koma untuk multiple tags</small>
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Gambar/Thumbnail</label>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               onchange="previewImage(this)">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Untuk video, upload thumbnail.</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    </div>

                    <div class="mb-3" id="videoUrlField" style="display: none;">
                        <label for="video_url" class="form-label">URL Video</label>
                        <input type="url" 
                               class="form-control @error('video_url') is-invalid @enderror" 
                               id="video_url" 
                               name="video_url" 
                               value="{{ old('video_url') }}" 
                               placeholder="https://youtube.com/watch?v=...">
                        <small class="form-text text-muted">URL video dari YouTube, Vimeo, atau platform lainnya</small>
                        @error('video_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.documentation.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>Simpan Dokumentasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Panduan</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-lightbulb me-2"></i>Tips Dokumentasi</h6>
                    <ul class="mb-0 small">
                        <li>Gunakan judul yang deskriptif dan menarik</li>
                        <li>Upload gambar berkualitas tinggi</li>
                        <li>Untuk video, sertakan URL yang valid</li>
                        <li>Tambahkan tags untuk memudahkan pencarian</li>
                        <li>Hubungkan dengan event jika relevan</li>
                    </ul>
                </div>

                <div class="alert alert-warning">
                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Catatan</h6>
                    <ul class="mb-0 small">
                        <li>Draft tidak akan tampil di website</li>
                        <li>Gambar akan dikompresi otomatis</li>
                        <li>Video URL harus dapat diakses publik</li>
                        <li>Tags membantu filter di galeri</li>
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
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.style.display = 'none';
    }
}

// Show/hide video URL field based on type selection
document.getElementById('type').addEventListener('change', function() {
    const videoUrlField = document.getElementById('videoUrlField');
    if (this.value === 'video') {
        videoUrlField.style.display = 'block';
    } else {
        videoUrlField.style.display = 'none';
    }
});

// Show video URL field if video is pre-selected
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    if (typeSelect.value === 'video') {
        document.getElementById('videoUrlField').style.display = 'block';
    }
});
</script>
@endsection
