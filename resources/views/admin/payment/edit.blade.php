<x-admin>
    @section('title', 'Update Pembayaran')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                        <h3 class="card-title mb-0">Update Pembayaran</h3>
                        <a href="{{ route('admin.transaction.index') }}" class="btn btn-info btn-sm">Back</a>
                    </div>
                    <form action="{{ route('admin.payment.update', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Kode Transaksi:</strong>
                                <p>{{ $payment->transaction->kode_transaksi }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Total Harga:</strong>
                                <p>Rp {{ number_format($payment->transaction->total_harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="mb-3">
                                <label>Jumlah Bayar</label>
                                <input type="number" name="jumlah_bayar" class="form-control" min="0.1" step="0.1"
                                    required value="{{ $payment->jumlah_bayar }}">
                                @error('jumlah_bayar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Metode Pembayaran</label>
                                <select name="metode" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="Cash" {{ $payment->metode=='Cash'?'selected':'' }}>Cash</option>
                                    <option value="Transfer" {{ $payment->metode=='Transfer'?'selected':'' }}>Transfer</option>
                                    <option value="Debit" {{ $payment->metode=='Debit'?'selected':'' }}>Debit</option>
                                </select>
                                @error('metode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>
