<x-admin>
    @section('title', 'Create Company')

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title fw-bold"><i class="fas fa-cogs me-2"></i> Pengaturan Master Laundry</h3>
        </div>
        <form action="{{ route('admin.company.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Nama Laundry <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Contoh: LaraLaundry" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="telephone">Nomor WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" id="telephone" placeholder="Contoh: 08123456789" value="{{ old('telephone') }}" required>
                            @error('telephone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="address">Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="3" placeholder="Alamat lengkap laundry..." required>{{ old('address') }}</textarea>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="footer_message">Catatan Bawah Struk (Footer)</label>
                    <textarea name="footer_message" class="form-control @error('footer_message') is-invalid @enderror" id="footer_message" rows="3" placeholder="Contoh: Terimakasih telah mempercayakan cucian Anda pada kami.">{{ old('footer_message') }}</textarea>
                    @error('footer_message')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="logo">Logo Laundry</label>
                    <div class="custom-file">
                        <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" id="logo">
                        <label class="custom-file-label" for="logo">Pilih file logo...</label>
                    </div>
                    @error('logo')
                        <span class="text-danger small mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer bg-light text-end">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</x-admin>
