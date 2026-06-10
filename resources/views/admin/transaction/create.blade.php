<x-admin>
    @section('title', 'Tambah Transaksi')

    {{-- Add Select2 CSS --}}
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
            padding-left: 12px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
    </style>
    @endpush

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Tambah Transaksi</h3>
                        <a href="{{ route('admin.transaction.index') }}" class="btn btn-info btn-sm">Back
                        </a>
                    </div>

                    <form action="{{ route('admin.transaction.store') }}" method="POST">
                        @csrf
                        <div class="card-body">

                            {{-- Customer with Select2 AJAX Search --}}
                            <div class="form-group mb-3">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control" required>
                                    <option value="">-- Ketik untuk mencari customer --</option>
                                </select>
                                <small class="text-muted">Ketik nama atau nomor telepon customer</small>
                                @error('customer_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Tanggal Masuk --}}
                            <div class="form-group mb-3">
                                <label>Tanggal Masuk</label>
                                <input type="datetime-local" name="tanggal_masuk" class="form-control" required>
                                @error('tanggal_masuk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Layanan --}}
                            <div id="service-wrapper">
                                <label class="fw-bold mb-2">Layanan</label>
                                <div class="service-item d-flex gap-2 mb-2">
                                    <select name="services[0][service_id]" class="form-control" required>
                                        <option value="">-- Pilih Layanan --</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">
                                                {{ $service->nama_layanan }} (Rp
                                                {{ number_format($service->harga_per_kg, 0, ',', '.') }}/kg)
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="services[0][berat]" step="0.1" min="0.1"
                                        class="form-control" placeholder="Berat (kg)" required>
                                    <button type="button" class="btn btn-danger btn-sm remove-service">&times;</button>
                                </div>
                            </div>

                            <button type="button" id="add-service" class="btn btn-outline-primary btn-sm mt-2">
                                + Tambah Layanan
                            </button>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Select2 JS --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 with AJAX
            $('#customer_id').select2({
                placeholder: '-- Ketik untuk mencari customer --',
                allowClear: true,
                ajax: {
                    url: '{{ route("admin.search.customers") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function(customer) {
                                return {
                                    id: customer.id,
                                    text: customer.nama + ' - ' + customer.no_telp
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2 // Minimum 2 karakter untuk mulai search
            });
        });

        // Script untuk tambah/hapus layanan
        let index = 1;
        const wrapper = document.getElementById('service-wrapper');

        document.getElementById('add-service').addEventListener('click', function () {
            const item = wrapper.querySelector('.service-item').cloneNode(true);
            // reset nilai input/select
            item.querySelectorAll('input').forEach(input => input.value = '');
            item.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
            // update nama input sesuai index baru
            item.querySelectorAll('select').forEach(select => {
                select.name = `services[${index}][service_id]`;
            });
            item.querySelectorAll('input').forEach(input => {
                input.name = `services[${index}][berat]`;
            });
            wrapper.appendChild(item);
            index++;
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-service')) {
                const items = wrapper.querySelectorAll('.service-item');
                if (items.length > 1) { // jangan hapus jika tinggal 1
                    e.target.closest('.service-item').remove();
                }
            }
        });
    </script>
    @endpush
</x-admin>