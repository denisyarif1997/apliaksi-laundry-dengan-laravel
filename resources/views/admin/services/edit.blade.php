<x-admin>
    @section('title','Edit Layanan')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Layanan</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>

                    <form class="needs-validation" novalidate 
                        action="{{ route('admin.services.update', $data->id) }}" 
                        method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ $data->id }}">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_layanan">Nama Layanan</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="nama_layanan" 
                                    name="nama_layanan"
                                    placeholder="Masukkan nama layanan" 
                                    required 
                                    value="{{ old('nama_layanan', $data->nama_layanan) }}">
                            </div>
                            <x-error>nama_layanan</x-error>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="harga_per_kg">Harga per KG</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="harga_per_kg" 
                                    name="harga_per_kg"
                                    placeholder="Masukkan harga per KG" 
                                    required 
                                    value="{{ old('harga_per_kg', $data->harga_per_kg) }}">
                            </div>
                            <x-error>harga_per_kg</x-error>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="estimasi_waktu">Estimasi Waktu</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="estimasi_waktu" 
                                    name="estimasi_waktu"
                                    placeholder="Masukkan estimasi waktu (contoh: 2 Hari)" 
                                    required 
                                    value="{{ old('estimasi_waktu', $data->estimasi_waktu) }}">
                            </div>
                            <x-error>estimasi_waktu</x-error>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>
