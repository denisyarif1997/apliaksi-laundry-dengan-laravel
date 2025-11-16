<x-admin>
    @section('title','Edit Mesin Laundry')

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Mesin Laundry</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.mesincuci.index') }}" class="btn btn-info btn-sm">Back</a>
                    </div>
                </div>

                <form class="needs-validation" novalidate 
                      action="{{ route('admin.mesincuci.update', $data->id) }}" 
                      method="POST">

                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $data->id }}">

                    <div class="card-body">

                        <div class="form-group">
                            <label for="kode_mesin">Kode Mesin</label>
                            <input type="text" class="form-control" id="kode_mesin" name="kode_mesin"
                                   placeholder="Enter Kode Mesin" required
                                   value="{{ old('kode_mesin', $data->kode_mesin) }}">
                            <x-error>kode_mesin</x-error>
                        </div>

                        <div class="form-group">
                            <label for="nama_mesin">Nama Mesin</label>
                            <input type="text" class="form-control" id="nama_mesin" name="nama_mesin"
                                   placeholder="Enter Nama Mesin" required
                                   value="{{ old('nama_mesin', $data->nama_mesin) }}">
                            <x-error>nama_mesin</x-error>
                        </div>

                        <div class="form-group">
                            <label for="kapasitas_kg">Kapasitas (kg)</label>
                            <input type="number" class="form-control" id="kapasitas_kg" name="kapasitas_kg"
                                   placeholder="Enter Kapasitas (kg)" required
                                   value="{{ old('kapasitas_kg', $data->kapasitas_kg) }}">
                            <x-error>kapasitas_kg</x-error>
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi"
                                   placeholder="Enter Lokasi" required
                                   value="{{ old('lokasi', $data->lokasi) }}">
                            <x-error>lokasi</x-error>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">-- Pilih Status --</option>

                                <option value="aktif"
                                    {{ old('status', $data->status) == 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="rusak"
                                    {{ old('status', $data->status) == 'rusak' ? 'selected' : '' }}>
                                    Rusak
                                </option>

                                <option value="maintenance"
                                    {{ old('status', $data->status) == 'maintenance' ? 'selected' : '' }}>
                                    Maintenance
                                </option>
                            </select>
                            <x-error>status</x-error>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Update</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

</x-admin>
