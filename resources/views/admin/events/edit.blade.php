@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit me-2"></i>Edit Event</h2>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Event</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Event <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $event->title) }}" 
                                       placeholder="Contoh: Touring Puncak BOI Bekasi"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Tipe Event <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" 
                                        id="type" 
                                        name="type" 
                                        required>
                                    <option value="">Pilih Tipe Event</option>
                                    <option value="kopdar" {{ old('type', $event->type) == 'kopdar' ? 'selected' : '' }}>Kopdar</option>
                                    <option value="touring" {{ old('type', $event->type) == 'touring' ? 'selected' : '' }}>Touring</option>
                                    <option value="baksos" {{ old('type', $event->type) == 'baksos' ? 'selected' : '' }}>Baksos</option>
                                    <option value="workshop" {{ old('type', $event->type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                    <option value="sunmori" {{ old('type', $event->type) == 'sunmori' ? 'selected' : '' }}>Sunmori</option>
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
                                  placeholder="Deskripsi detail event..."
                                  required>{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" 
                                       class="form-control @error('date') is-invalid @enderror" 
                                       id="date" 
                                       name="date" 
                                       value="{{ old('date', $event->date) }}" 
                                       required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="time" class="form-label">Waktu <span class="text-danger">*</span></label>
                                <input type="time" 
                                       class="form-control @error('time') is-invalid @enderror" 
                                       id="time" 
                                       name="time" 
                                       value="{{ old('time', $event->time) }}" 
                                       required>
                                @error('time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="max_participants" class="form-label">Maks. Peserta</label>
                                <input type="number" 
                                       class="form-control @error('max_participants') is-invalid @enderror" 
                                       id="max_participants" 
                                       name="max_participants" 
                                       value="{{ old('max_participants', $event->max_participants) }}" 
                                       min="1"
                                       placeholder="Kosongkan jika tidak terbatas">
                                @error('max_participants')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('location') is-invalid @enderror" 
                               id="location" 
                               name="location" 
                               value="{{ old('location', $event->location) }}" 
                               placeholder="Contoh: Cafe Rider, Jl. Raya Bekasi"
                               required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contact_person" class="form-label">Contact Person <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('contact_person') is-invalid @enderror" 
                                       id="contact_person" 
                                       name="contact_person" 
                                       value="{{ old('contact_person', $event->contact_person) }}" 
                                       placeholder="Nama penanggung jawab"
                                       required>
                                @error('contact_person')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contact_phone" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('contact_phone') is-invalid @enderror" 
                                       id="contact_phone" 
                                       name="contact_phone" 
                                       value="{{ old('contact_phone', $event->contact_phone) }}" 
                                       placeholder="08xxxxxxxxxx"
                                       required>
                                @error('contact_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fee" class="form-label">Biaya</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" 
                                           class="form-control @error('fee') is-invalid @enderror" 
                                           id="fee" 
                                           name="fee" 
                                           value="{{ old('fee', $event->fee) }}" 
                                           min="0"
                                           placeholder="0 (gratis)">
                                </div>
                                @error('fee')
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
                                    <option value="">Pilih Status</option>
                                    <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                    <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="requirements" class="form-label">Persyaratan</label>
                        <textarea class="form-control @error('requirements') is-invalid @enderror" 
                                  id="requirements" 
                                  name="requirements" 
                                  rows="3" 
                                  placeholder="Persyaratan khusus untuk mengikuti event (opsional)">{{ old('requirements', $event->requirements) }}</textarea>
                        @error('requirements')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Event</label>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               onchange="previewImage(this)">
                        <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Preview Gambar</h6>
            </div>
            <div class="card-body text-center">
                <img id="preview" 
                     src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/placeholder-event.jpg') }}" 
                     alt="Preview" 
                     class="img-fluid rounded"
                     style="max-height: 200px; object-fit: cover;">
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Event</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <strong>Dibuat:</strong><br>
                        <small class="text-muted">{{ $event->created_at->format('d M Y, H:i') }}</small>
                    </li>
                    <li class="mb-2">
                        <strong>Terakhir Update:</strong><br>
                        <small class="text-muted">{{ $event->updated_at->format('d M Y, H:i') }}</small>
                    </li>
                    <li class="mb-2">
                        <strong>Peserta Terdaftar:</strong><br>
                        <small class="text-muted">{{ $event->registered_participants ?? 0 }} orang</small>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        <small>Pastikan informasi sudah akurat</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        <small>Update status sesuai kondisi event</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        <small>Gambar baru akan mengganti yang lama</small>
                    </li>
                    <li>
                        <i class="fas fa-check text-success me-2"></i>
                        <small>Simpan perubahan secara berkala</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
