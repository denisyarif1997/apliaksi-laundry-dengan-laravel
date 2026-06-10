<x-admin>
    @section('title', 'Pembayaran Transaksi')
    
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold text-gray-800">Pembayaran Transaksi</h2>
            <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="row g-4">
            <!-- Left Column: Transaction Info & History -->
            <div class="col-lg-5">
                <!-- Transaction Details Card -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem; overflow: hidden;">
                    <div class="card-header bg-gradient-primary text-white p-3" style="background: linear-gradient(45deg, #4e73df, #224abe);">
                        <h5 class="m-0 fw-bold"><i class="fas fa-file-invoice me-2"></i>Detail Transaksi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3 d-flex justify-content-between border-bottom pb-2">
                            <span class="text-muted">Kode Transaksi</span>
                            <span class="fw-bold text-dark">{{ $transaction->kode_transaksi }}</span>
                        </div>
                        <div class="mb-3 d-flex justify-content-between border-bottom pb-2">
                            <span class="text-muted">Customer</span>
                            <span class="fw-bold text-dark">{{ $transaction->customer->nama ?? 'Umum' }}</span>
                        </div>
                        <div class="mb-3 d-flex justify-content-between border-bottom pb-2">
                            <span class="text-muted">Total Tagihan</span>
                            <span class="fw-bold text-primary" style="font-size: 1.1rem;">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="mb-3 d-flex justify-content-between border-bottom pb-2">
                            <span class="text-muted">Sudah Dibayar</span>
                            <span class="fw-bold text-success">Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-2">
                            <span class="text-uppercase fw-bold text-secondary text-xs">Sisa Tagihan</span>
                            <span class="display-6 fw-bold {{ $sisaTagihan > 0 ? 'text-danger' : 'text-success' }}" style="font-size: 1.5rem;">
                                Rp {{ number_format($sisaTagihan, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Payment History Card -->
                <div class="card border-0 shadow-sm" style="border-radius: 1rem; overflow: hidden;">
                    <div class="card-header bg-light p-3 border-bottom">
                        <h6 class="m-0 fw-bold text-gray-700"><i class="fas fa-history me-2"></i>Riwayat Pembayaran</h6>
                    </div>
                    <div class="card-body p-0">
                        @if($riwayatPembayaran->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Tanggal</th>
                                            <th>Metode</th>
                                            <th class="text-end pe-4">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($riwayatPembayaran as $pembayaran)
                                            <tr>
                                                <td class="ps-4 text-muted small">{{ $pembayaran->created_at->format('d M Y H:i') }}</td>
                                                <td><span class="badge bg-secondary rounded-pill">{{ $pembayaran->metode }}</span></td>
                                                <td class="text-end pe-4 fw-bold text-dark">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-info-circle mb-2"></i>
                                <p class="mb-0 small">Belum ada riwayat pembayaran.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Payment Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg h-100" style="border-radius: 1rem;">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow" style="width: 60px; height: 60px;">
                                <i class="fas fa-wallet fa-lg"></i>
                            </div>
                            <h4 class="fw-bold text-gray-800">Input Pembayaran</h4>
                            <p class="text-muted">Silakan masukkan nominal pembayaran baru.</p>
                        </div>

                        @if($sisaTagihan > 0)
                            <form action="{{ route('admin.payment.store', $transaction->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-gray-700">Nominal Pembayaran</label>
                                    <div class="input-group input-group-lg shadow-sm">
                                        <span class="input-group-text bg-light border-0 fw-bold text-muted">Rp</span>
                                        <input type="number" 
                                               name="jumlah_bayar" 
                                               class="form-control border-0 bg-light fw-bold text-dark" 
                                               min="0.1" 
                                               step="any"
                                               max="{{ $sisaTagihan }}"
                                               value="{{ old('jumlah_bayar', $sisaTagihan) }}" 
                                               placeholder="0"
                                               required
                                               style="font-size: 1.25rem;">
                                    </div>
                                    @error('jumlah_bayar')
                                        <small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                    @enderror
                                    <div class="form-text mt-2 text-end">
                                        Maksimal pembayaran: <span class="fw-bold text-primary" id="max-pay" style="cursor:pointer;" onclick="document.querySelector('[name=jumlah_bayar]').value={{ $sisaTagihan }}">Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-gray-700">Metode Pembayaran</label>
                                    <div class="row g-2">
                                        @foreach(['Cash', 'Transfer', 'Debit', 'QRIS'] as $method)
                                        <div class="col-6 col-md-3">
                                            <input type="radio" class="btn-check" name="metode" id="method_{{ $method }}" value="{{ $method }}" {{ old('metode') == $method ? 'checked' : '' }} required>
                                            <label class="btn btn-outline-primary w-100 py-3 rounded-3 fw-bold" for="method_{{ $method }}">
                                                {{ $method }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('metode')
                                        <small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-grid mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg py-3 shadow-sm fw-bold">
                                        <i class="fas fa-save me-2"></i> Proses Pembayaran
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-success border-0 shadow-sm p-4 text-center rounded-3">
                                <div class="mb-3 text-success">
                                    <i class="fas fa-check-circle fa-3x"></i>
                                </div>
                                <h4 class="alert-heading fw-bold">Lunas!</h4>
                                <p class="mb-0">Transaksi ini sudah dibayar lunas. Tidak ada tagihan tersisa.</p>
                                <hr>
                                <a href="{{ route('admin.transaction.index') }}" class="btn btn-outline-success fw-bold">Kembali ke Transaksi</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>