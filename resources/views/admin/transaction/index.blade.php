<x-admin>
    @section('title', 'Daftar Transaksi')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Transaksi Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.transaction.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="transactionTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Transaksi</th>
                        <th>Customer</th>
                        <TH>No Telepon</TH>
                        <th>Order Masuk</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Total Dibayar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $trx)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $trx->kode_transaksi }}</td>
                            <td>{{ $trx->customer->nama ?? '-' }}</td>
                            <td>{{ $trx->customer->no_telp ?? '-' }}</td>
                            <td>{{ $trx->tanggal_masuk }}</td>
                            <td>
                                <span class="badge 
                                            @if($trx->status == 'pending') bg-warning 
                                            @elseif($trx->status == 'proses') bg-info
                                            @elseif($trx->status == 'selesai') bg-success
                                            @elseif ($trx->status == 'batal') bg-danger
                                            @elseif ($trx->status == 'lunas') bg-primary
                                            @else bg-secondary @endif">
                                    {{ ucfirst($trx->status) }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($trx->payments()->sum('jumlah_bayar'), 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.transaction.show', $trx->id) }}"
                                    class="btn btn-sm btn-success">Detail</a>
                                <a href="{{ route('admin.transaction.edit', $trx->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                {{-- Tombol Bayar --}}
                                @if ($trx->status != 'selesai')
                                    <a href="{{ route('admin.payment.create', $trx->id) }}"
                                        class="btn btn-sm btn-primary">Bayar</a>
                                @endif

                                {{-- Tombol Hapus --}}
                                @if ($trx->status != 'lunas' && $trx->status != 'proses' && $trx->status != 'selesai' && $trx->status != 'diambil')
                                    <form action="{{ route('admin.transaction.destroy', $trx->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        onclick="alert('Transaksi sudah di proses atau sudah dibayar, tidak bisa dihapus!')">
                                        Hapus
                                    </button>
                                @endif
                                <form action="{{ route('admin.transaction.updateStatus', $trx->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-info"
                                        onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi diambil?')">
                                        Diambil
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('js')
        <script>
            $(function () {
                $('#transactionTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>