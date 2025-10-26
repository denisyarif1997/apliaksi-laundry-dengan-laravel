<x-admin>
    @section('title','Create Layanan')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Layanan</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.services.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_layanan">Layanan Name</label>
                                <input type="text" class="form-control" id="nama_layanan" name="nama_layanan"
                                    placeholder="Enter Layanan name" required value="{{ old('nama_layanan') }}">
                            </div>
                            <x-error>nama</x-error>
                        </div>
                         <div class="card-body">
                            <div class="form-group">
                                <label for="harga_per_kg">Harga per KG</label>
                                <input type="number" class="form-control" id="harga_per_kg" name="harga_per_kg"
                                    placeholder="Enter Harga per KG" required value="{{ old('harga_per_kg') }}">
                            </div>
                            <x-error>harga_per_kg</x-error>
                        </div>
                         <div class="card-body">
                            <div class="form-group">
                                <label for="estimasi_waktu">Estimasi Waktu</label>
                                <input type="text" class="form-control" id="estimasi_waktu" name="estimasi_waktu"
                                    placeholder="Enter Estimasi Waktu" required value="{{ old('estimasi_waktu') }}">
                            </div>
                            <x-error>estimasi_waktu</x-error>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>
