<x-admin>
    @section('title','Create Item')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Items</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.item.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.item.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Item Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Item name" required value="{{ old('name') }}">
                            </div>
                            <x-error>name</x-error>
                        </div>
                         <div class="card-body">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan"
                                    placeholder="Enter Satuan" required value="{{ old('satuan') }}">
                            </div>
                            <x-error>satuan</x-error>
                        </div>
                         {{-- <div class="card-body">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>  
                                <textarea class="form-control" id="alamat" name="alamat"
                                    placeholder="Enter Alamat" required>{{ old('alamat') }}</textarea>
                            </div>
                            <x-error>alamat</x-error>
                        </div> --}}
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>
