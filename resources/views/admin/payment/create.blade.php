<x-admin>
    @section('title', 'Pembayaran Transaksi')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                        <h3 class="card-title mb-0">Pembayaran Transaksi</h3>
                        <a href="{{ route('admin.transaction.index') }}" class="btn btn-info btn-sm">Back</a>
                    </div>
                    <form action="{{ route('admin.payment.store', $transaction->id) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Kode Transaksi:</strong>
                                <p>{{ $transaction->kode_transaksi }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Total Harga:</strong>
                                <p>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="mb-3">
                                <label>Jumlah Bayar</label>
                                <input type="number" name="jumlah_bayar" class="form-control" min="0.1" step="0.1"
                                    required value="{{ number_format($transaction->total_harga) }}"
                                @error('jumlah_bayar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Metode Pembayaran</label>
                                <select name="metode" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="Debit">Debit</option>
                                </select>
                                @error('metode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>