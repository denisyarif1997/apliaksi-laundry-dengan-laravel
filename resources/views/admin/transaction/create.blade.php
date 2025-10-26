<x-admin>
    @section('title', 'Tambah Transaksi')

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Tambah Transaksi</h3>
                        <a href="{{ route('admin.transaction.index') }}" class="btn btn-info btn-sm">Back</a>
                        {{-- <i class="bi bi-arrow-left"></i> Back --}}
                        </a>
                    </div>

                    <form action="{{ route('admin.transaction.store') }}" method="POST">
                        @csrf
                        <div class="card-body">

                            {{-- Customer --}}
                            <div class="form-group mb-3">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control" required>
                                    <option value="">-- Pilih Customer --</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                                    @endforeach
                                </select>
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

    {{-- Script untuk tambah/hapus layanan --}}
    <script>
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
</x-admin>