@extends('layouts.admin')

@section('title', 'Edit Member - Admin BOI Bekasi')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Edit Member</h1>
                    <p class="text-muted">Edit data member {{ $member->name }}</p>
                </div>
                <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user-edit me-2"></i>
                        Form Edit Member
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.members.update', $member) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $member->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $member->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nrp" class="form-label">NRP (Nomor Registrasi Pokok)</label>
                                <input type="text" class="form-control @error('nrp') is-invalid @enderror" 
                                       id="nrp" name="nrp" value="{{ old('nrp', $member->nrp) }}" 
                                       placeholder="Contoh: BOI-BKS-001">
                                @error('nrp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">NRP harus unik untuk setiap member. Kosongkan jika belum ada.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">No. Telepon</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone', $member->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="join_date" class="form-label">Tanggal Bergabung <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('join_date') is-invalid @enderror" 
                                       id="join_date" name="join_date" value="{{ old('join_date', $member->join_date) }}" required>
                                @error('join_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="bike_type" class="form-label">Jenis Motor <span class="text-danger">*</span></label>
                                <select class="form-select @error('bike_type') is-invalid @enderror" 
                                        id="bike_type" name="bike_type" required>
                                    <option value="">Pilih Jenis Motor</option>
                                    <option value="Benelli TNT 135" {{ old('bike_type', $member->bike_type) == 'Benelli TNT 135' ? 'selected' : '' }}>Benelli TNT 135</option>
                                    <option value="Benelli Leoncino 250" {{ old('bike_type', $member->bike_type) == 'Benelli Leoncino 250' ? 'selected' : '' }}>Benelli Leoncino 250</option>
                                    <option value="Benelli TRK 251" {{ old('bike_type', $member->bike_type) == 'Benelli TRK 251' ? 'selected' : '' }}>Benelli TRK 251</option>
                                    <option value="Benelli TNT 600i" {{ old('bike_type', $member->bike_type) == 'Benelli TNT 600i' ? 'selected' : '' }}>Benelli TNT 600i</option>
                                    <option value="Benelli Imperiale 400" {{ old('bike_type', $member->bike_type) == 'Benelli Imperiale 400' ? 'selected' : '' }}>Benelli Imperiale 400</option>
                                    <option value="Benelli Leoncino 500" {{ old('bike_type', $member->bike_type) == 'Benelli Leoncino 500' ? 'selected' : '' }}>Benelli Leoncino 500</option>
                                    <option value="Benelli TNT 300" {{ old('bike_type', $member->bike_type) == 'Benelli TNT 300' ? 'selected' : '' }}>Benelli TNT 300</option>
                                </select>
                                @error('bike_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="bike_year" class="form-label">Tahun Motor</label>
                                <input type="text" class="form-control @error('bike_year') is-invalid @enderror" 
                                       id="bike_year" name="bike_year" value="{{ old('bike_year', $member->bike_year) }}" placeholder="2023">
                                @error('bike_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="bike_color" class="form-label">Warna Motor</label>
                                <input type="text" class="form-control @error('bike_color') is-invalid @enderror" 
                                       id="bike_color" name="bike_color" value="{{ old('bike_color', $member->bike_color) }}" placeholder="Hitam">
                                @error('bike_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="active" {{ old('status', $member->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status', $member->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="photo" class="form-label">Foto Profil</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                       id="photo" name="photo" accept="image/*">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</div>
                                <div class="mt-2">
                                    <small class="text-muted">Foto saat ini:</small><br>
                                    <img src="{{ $member->photo_url }}" alt="Current Photo" class="img-thumbnail" style="max-width: 100px; max-height: 100px;"
                                         onerror="this.src='{{ asset('images/default-member.svg') }}'">
                                    @if(!$member->photo)
                                        <small class="text-muted d-block mt-1">Menggunakan foto default</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3" placeholder="Alamat lengkap member">{{ old('address', $member->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3" placeholder="Catatan tambahan tentang member">{{ old('notes', $member->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Update Member
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Member
                    </h5>
                </div>
                <div class="card-body">
                    <h6>Data Member:</h6>
                    <ul class="list-unstyled">
                        <li><strong>Nama:</strong> {{ $member->name }}</li>
                        <li><strong>Email:</strong> {{ $member->email }}</li>
                        <li><strong>Motor:</strong> {{ $member->bike_type }}</li>
                        <li><strong>Status:</strong> 
                            <span class="badge bg-{{ $member->status == 'active' ? 'success' : 'secondary' }}">
                                {{ $member->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </li>
                        <li><strong>Bergabung:</strong> {{ \Carbon\Carbon::parse($member->join_date)->format('d M Y') }}</li>
                    </ul>
                    
                    <hr>
                    
                    <h6>Tips:</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-lightbulb text-warning me-2"></i>Pastikan data yang dimasukkan akurat</li>
                        <li><i class="fas fa-lightbulb text-warning me-2"></i>Email harus unik untuk setiap member</li>
                        <li><i class="fas fa-lightbulb text-warning me-2"></i>Kosongkan foto jika tidak ingin mengubah</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
