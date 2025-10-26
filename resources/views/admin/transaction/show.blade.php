<x-admin>
    @section('title', 'Detail Transaksi')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Detail Transaksi</h3>
                        <div>
                            <a href="{{ route('admin.transaction.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            <button onclick="printDiv('printArea')" class="btn btn-sm btn-primary">
                                <i class="bi bi-printer"></i> Print
                            </button>
                        </div>
                    </div>

                    <div class="card-body" id="printArea">
                        <div class="mb-3">
                            <strong>Kode Transaksi:</strong>
                            <p>{{ $transaction->kode_transaksi }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Customer:</strong>
                            <p>{{ $transaction->customer->nama ?? '-' }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Tanggal Masuk:</strong>
                            <p>{{ $transaction->tanggal_masuk }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Tanggal Selesai:</strong>
                            <p>{{ $transaction->tanggal_selesai ?? '-' }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Status:</strong>
                            <span class="badge 
                                @if($transaction->status == 'pending') bg-warning
                                @elseif($transaction->status == 'proses') bg-info
                                @elseif($transaction->status == 'selesai') bg-success
                                @else bg-secondary @endif">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </div>

                        <hr>

                        <h5 class="mt-3">Rincian Layanan</h5>
                        <table class="table table-bordered table-sm mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Layanan</th>
                                    <th>Berat (kg)</th>
                                    <th>Harga/kg</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction->details as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->service->nama_layanan ?? '-' }}</td>
                                        <td>{{ $detail->berat }}</td>
                                        <td>Rp {{ number_format($detail->service->harga_per_kg ?? 0, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total</th>
                                    <th>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            function printDiv(divId) {
                var printContents = document.getElementById(divId).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
                location.reload(); // reload page untuk mengembalikan JS/stylesheet
            }
        </script>
    @endsection
</x-admin>
