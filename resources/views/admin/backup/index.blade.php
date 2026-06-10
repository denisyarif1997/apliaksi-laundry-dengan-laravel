<x-admin>
    @section('title', 'Database Backup')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Backup Database</h3>
                    <div class="card-tools">
                        <form action="{{ route('admin.backup.store') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Buat Backup Baru
                            </button>
                        </form>
                        <button type="button" class="btn btn-warning btn-sm ml-2" data-toggle="modal" data-target="#importModal">
                            <i class="fas fa-file-import"></i> Import Database
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama File</th>
                                <th>Ukuran</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($backups as $index => $backup)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <i class="fas fa-database text-secondary mr-2"></i>
                                    <strong>{{ $backup['filename'] }}</strong>
                                </td>
                                <td>{{ $backup['size'] }}</td>
                                <td>{{ $backup['date'] }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.backup.download', $backup['filename']) }}" class="btn btn-sm btn-info" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <form action="{{ route('admin.backup.destroy', $backup['filename']) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus backup ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <img src="{{ asset('admin/dist/img/empty.svg') }}" alt="Empty" style="height: 100px; opacity: 0.5" class="mb-2">
                                    <p class="text-muted">Belum ada file backup</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="callout callout-info mt-3">
                <h5><i class="fas fa-info"></i> Note:</h5>
                File backup disimpan di folder <code>storage/app/backups</code>. Pastikan untuk mendownload dan menyimpan backup di tempat aman secara berkala.
            </div>

            {{-- Danger Zone --}}
            <div class="card card-danger mt-4">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-exclamation-triangle"></i> Danger Zone</h3>
                </div>
                <div class="card-body">
                    <p class="text-danger">
                        <strong>PERHATIAN:</strong> Fitur ini akan menghapus <strong>SELURUH DATA TRANSAKSI</strong>. 
                        Data yang dihapus tidak dapat dikembalikan. Pastikan Anda sudah melalukan backup terlebih dahulu.
                    </p>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#resetModal">
                        <i class="fas fa-trash-alt"></i> Reset Database Transaksi
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Reset Modal --}}
    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="resetModalLabel">Konfirmasi Reset Database</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.backup.reset') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Anda akan menghapus seluruh data transaksi. Tindakan ini <strong>TIDAK DAPAT DIBATALKAN</strong>.</p>
                        <div class="form-group">
                            <label for="password">Masukkan Password Konfirmasi:</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password reset">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, Hapus Semua Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Import Modal --}}
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="importModalLabel">Import Database</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.backup.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> <strong>PERHATIAN!</strong><br>
                            Proses ini akan <strong>MENIMPA</strong> seluruh data database saat ini dengan data dari file backup. 
                            Pastikan Anda sudah melakukan backup data saat ini sebelum melanjutkan.
                        </div>
                        <div class="form-group">
                            <label for="backup_file">Pilih File Backup (.sql):</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="backup_file" name="backup_file" accept=".sql,.txt" required>
                                <label class="custom-file-label" for="backup_file">Pilih file...</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Mulai Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin>
