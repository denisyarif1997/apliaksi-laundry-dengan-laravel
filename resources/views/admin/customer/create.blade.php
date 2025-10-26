<x-admin>
    @section('title','Create Customer')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Customer</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.customer.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.customer.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Customer Name</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Enter Customer name" required value="{{ old('nama') }}">
                            </div>
                            <x-error>nama</x-error>
                        </div>
                         <div class="card-body">
                            <div class="form-group">
                                <label for="no_telp">No Telepon</label>
                                <input type="number" class="form-control" id="no_telp" name="no_telp"
                                    placeholder="Enter No Telepon" required value="{{ old('no_telp') }}">
                            </div>
                            <x-error>no_tlp</x-error>
                        </div>
                         <div class="card-body">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>  
                                <textarea class="form-control" id="alamat" name="alamat"
                                    placeholder="Enter Alamat" required>{{ old('alamat') }}</textarea>
                            </div>
                            <x-error>alamat</x-error>
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
