<x-admin>
    @section('title', 'Daftar Transaksi')
    
    {{-- Filter Card --}}
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-filter"></i> Filter Transaksi</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transaction.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" 
                           value="{{ $startDate ?? \Carbon\Carbon::now()->subMonth()->format('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" 
                           value="{{ $endDate ?? \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

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
                        {{-- <th>Layanan</th> --}}
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
                            {{-- <td>{{ $trx->services->service_id ?? '-' }}</td> --}}
                            <td>{{ $trx->customer->nama ?? '-' }}</td>
                            <td>
                                @if($trx->customer && $trx->customer->no_telp)
                                    @php
                                        // Bersihkan nomor dari karakter non-numerik
                                        $cleanNumber = preg_replace('/[^0-9]/', '', $trx->customer->no_telp);
                                        
                                        // Jika diawali 0, ganti dengan 62
                                        if (substr($cleanNumber, 0, 1) === '0') {
                                            $whatsappNumber = '62' . substr($cleanNumber, 1);
                                        } 
                                        // Jika sudah diawali 62, biarkan
                                        elseif (substr($cleanNumber, 0, 2) === '62') {
                                            $whatsappNumber = $cleanNumber;
                                        } 
                                        // Jika format lain, tambahkan 62 di depan
                                        else {
                                            $whatsappNumber = '62' . $cleanNumber;
                                        }
                                    @endphp
                                    {{ $trx->customer->no_telp }}
                                    <a href="https://wa.me/{{ $whatsappNumber }}" 
                                       target="_blank" 
                                       class="btn btn-success btn-sm ms-1"
                                       title="Chat WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
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
                            <td class="text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#actionModal{{ $trx->id }}" title="Action Menu">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modals Section --}}
   @foreach ($transactions as $trx)
<!-- Action Modal for {{ $trx->kode_transaksi }} -->
<div class="modal fade" id="actionModal{{ $trx->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            
            <div class="modal-header bg-light border-0">
                <h5 class="modal-title fw-bold">
                    <span class="text-primary">#{{ $trx->kode_transaksi }}</span>
                    <small class="text-muted ms-2">Menu Aksi</small>
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row g-3 text-center">

                    {{-- Cetak --}}
                    <div class="col-6">
                        <a href="{{ route('admin.transaction.print', $trx->id) }}" target="_blank"
                           class="btn btn-outline-secondary w-100 py-3 rounded-3">
                            <i class="fas fa-print fa-2x mb-2"></i>
                            <div class="fw-semibold">Cetak</div>
                        </a>
                    </div>

                    {{-- Detail --}}
                    <div class="col-6">
                        <a href="{{ route('admin.transaction.show', $trx->id) }}"
                           class="btn btn-outline-info w-100 py-3 rounded-3">
                            <i class="fas fa-eye fa-2x mb-2"></i>
                            <div class="fw-semibold">Detail</div>
                        </a>
                    </div>

                    {{-- Edit --}}
                    <div class="col-6">
                        <a href="{{ route('admin.transaction.edit', $trx->id) }}"
                           class="btn btn-outline-warning w-100 py-3 rounded-3">
                            {{-- <i class="fas fa-pen-to-square fa-2x mb-2"></i> --}}
                            <i class="fas fa-edit fa-2x mb-2"></i>
                            <div class="fw-semibold">Edit</div>
                        </a>
                    </div>

                    {{-- Bayar --}}
                    @if ($trx->status != 'selesai')
                    <div class="col-6">
                        <a href="{{ route('admin.payment.create', $trx->id) }}"
                           class="btn btn-outline-primary w-100 py-3 rounded-3">
                            <i class="fas fa-credit-card fa-2x mb-2"></i>
                            <div class="fw-semibold">Bayar</div>
                        </a>
                    </div>
                    @endif

                    {{-- Proses --}}
                    <div class="col-6">
                        <form action="{{ route('admin.transaction.updateStatusProses', $trx->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="btn btn-outline-warning w-100 py-3 rounded-3">
                                {{-- <i class="fas fa-gears fa-2x mb-2"></i> --}}
                                <i class="fas fa-cogs fa-2x mb-2"></i>
                                <div class="fw-semibold">Proses</div>
                            </button>
                        </form>
                    </div>

                      {{-- Selsai --}}
                    <div class="col-6">
                        <form action="{{ route('admin.transaction.updateStatusSelesai', $trx->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="btn btn-outline-warning w-100 py-3 rounded-3">
                                {{-- <i class="fas fa-gears fa-2x mb-2"></i> --}}
                                <i class="fas fa-cogs fa-2x mb-2"></i>
                                <div class="fw-semibold">Selesai</div>
                            </button>
                        </form>
                    </div>

                    {{-- Diambil --}}
                    <div class="col-6">
                        <form action="{{ route('admin.transaction.updateStatus', $trx->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="btn btn-outline-success w-100 py-3 rounded-3">
                                <i class="fas fa-box-open fa-2x mb-2"></i>
                                <div class="fw-semibold">Diambil</div>
                            </button>
                        </form>
                    </div>

                    {{-- Hapus --}}
                    @if ($trx->status != 'lunas' && $trx->status != 'proses' && $trx->status != 'selesai' && $trx->status != 'diambil')
                    <div class="col-12 mt-3">
                        <form action="{{ route('admin.transaction.destroy', $trx->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-outline-danger w-100 rounded-3 fw-semibold">
                                <i class="fas fa-trash me-2"></i> Hapus Transaksi
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="col-12 mt-3">
                        <button type="button"
                            class="btn btn-outline-secondary w-100 rounded-3 fw-semibold"
                            disabled>
                            <i class="fas fa-lock me-2"></i> Hapus Terkunci
                        </button>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

    @section('js')
        <script>
            $(function () {
                $('#transactionTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                    "autoWidth": false,
                });
            });
        </script>
    @endsection
</x-admin>