<x-admin>
    @section('title','Create Data Mesin Laundry')

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Data Mesin Laundry</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.mesincuci.index') }}" class="btn btn-info btn-sm">Back</a>
                    </div>
                </div>

                <form class="needs-validation" novalidate action="{{ route('admin.mesincuci.store') }}" method="POST">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label for="kode_mesin">Kode Mesin</label>
                            <input type="text" class="form-control" id="kode_mesin" name="kode_mesin"
                                   placeholder="Enter Kode Mesin" required value="{{ old('kode_mesin') }}">
                            <x-error>kode_mesin</x-error>
                        </div>

                        <div class="form-group">
                            <label for="nama_mesin">Nama Mesin</label>
                            <input type="text" class="form-control" id="nama_mesin" name="nama_mesin"
                                   placeholder="Enter Nama Mesin" required value="{{ old('nama_mesin') }}">
                            <x-error>nama_mesin</x-error>
                        </div>

                        <div class="form-group">
                            <label for="kapasitas_kg">Kapasitas (kg)</label>
                            <input type="number" class="form-control" id="kapasitas_kg" name="kapasitas_kg"
                                   placeholder="Enter Kapasitas (kg)" required value="{{ old('kapasitas_kg') }}">
                            <x-error>kapasitas_kg</x-error>
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi"
                                   placeholder="Enter Lokasi" required value="{{ old('lokasi') }}">
                            <x-error>lokasi</x-error>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="aktif" {{ old('status')=='aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="rusak" {{ old('status')=='rusak' ? 'selected' : '' }}>Rusak</option>
                                <option value="maintenance" {{ old('status')=='maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            <x-error>status</x-error>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

</x-admin>
