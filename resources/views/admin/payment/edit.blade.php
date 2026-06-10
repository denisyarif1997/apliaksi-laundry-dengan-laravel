<x-admin>
    @section('title', 'Update Pembayaran')
    
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold text-gray-800">Edit Pembayaran</h2>
            <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg" style="border-radius: 1rem;">
                    <div class="card-header bg-warning text-white p-3" style="background: linear-gradient(45deg, #f6c23e, #dda20a);">
                        <h5 class="m-0 fw-bold"><i class="fas fa-edit me-2"></i>Edit Data Pembayaran</h5>
                    </div>
                    <form action="{{ route('admin.payment.update', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body p-5">
                            <!-- Info Transaksi -->
                            <div class="alert alert-light border shadow-sm mb-4">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Kode Transaksi:</span>
                                    <span class="fw-bold">{{ $payment->transaction->kode_transaksi }}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span class="text-muted">Total Tagihan Transaksi:</span>
                                    <span class="fw-bold">Rp {{ number_format($payment->transaction->total_harga, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-gray-700">Nominal Pembayaran</label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <span class="input-group-text bg-light border-0 fw-bold text-muted">Rp</span>
                                    <input type="number" 
                                           name="jumlah_bayar" 
                                           class="form-control border-0 bg-light fw-bold text-dark" 
                                           min="0.1" 
                                           step="any"
                                           required 
                                           value="{{ old('jumlah_bayar', $payment->jumlah_bayar) }}"
                                           style="font-size: 1.25rem;">
                                </div>
                                <small class="text-muted ms-1">Nominal sebelumnya: Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</small>
                                @error('jumlah_bayar')
                                    <small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-gray-700">Metode Pembayaran</label>
                                <div class="row g-2">
                                    @foreach(['Cash', 'Transfer', 'Debit', 'QRIS'] as $method)
                                    <div class="col-6 col-md-3">
                                        <input type="radio" class="btn-check" name="metode" id="method_{{ $method }}" value="{{ $method }}" {{ (old('metode', $payment->metode) == $method) ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-warning w-100 py-3 rounded-3 fw-bold text-dark" for="method_{{ $method }}">
                                            {{ $method }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @error('metode')
                                    <small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer bg-white p-4 text-end border-top-0 rounded-bottom">
                            <button type="submit" class="btn btn-warning btn-lg shadow-sm fw-bold text-dark">
                                <i class="fas fa-save me-2"></i> Update Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>
