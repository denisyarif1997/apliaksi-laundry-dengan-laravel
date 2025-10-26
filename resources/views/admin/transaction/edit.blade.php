<x-admin>
    @section('title', 'Edit Transaksi')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Edit Transaksi</h3>
                        <a href="{{ route('admin.transaction.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>

                    <form action="{{ route('admin.transaction.update', $transaction->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label for="kode_transaksi">Kode Transaksi</label>
                                <input type="text" id="kode_transaksi" class="form-control" value="{{ $transaction->kode_transaksi }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control" required>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $transaction->customer_id == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tanggal_masuk">Tanggal Masuk</label>
                                <input type="datetime-local" id="tanggal_masuk" name="tanggal_masuk" class="form-control" value="{{ $transaction->tanggal_masuk }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="datetime-local" id="tanggal_selesai" name="tanggal_selesai" class="form-control" value="{{ $transaction->tanggal_selesai }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="proses" {{ $transaction->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ $transaction->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="diambil" {{ $transaction->status == 'diambil' ? 'selected' : '' }}>Diambil</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Total Harga</label>
                                <input type="text" class="form-control" value="Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}" readonly>
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
