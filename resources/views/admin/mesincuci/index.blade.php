<x-admin>
    @section('title','Mesin Laundry')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mesin Laundry Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.mesincuci.create') }}" class="btn btn-sm btn-info">New</a>
                    {{-- <i class="btn btn-sm btn-info"></i> New --}}
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Search Form -->
            <div class="mb-3">
                <form action="{{ route('admin.mesincuci.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search mesin laundry..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.mesincuci.index') }}" class="btn btn-secondary">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Info -->
            @if($data->total() > 0)
            <div class="mb-2">
                <small class="text-muted">
                    Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
                </small>
            </div>
            @endif

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kode Mesin</th>
                        <th>Nama Mesin</th>
                        <th>Kapasitas (kg)</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $cat)
                        <tr>
                            <td>{{ $data->firstItem() + $index }}</td>
                            <td>{{ $cat->kode_mesin }}</td>
                            <td>{{ $cat->nama_mesin }}</td>
                            <td>{{ $cat->kapasitas_kg }}</td>
                            <td>{{ $cat->lokasi }}</td>
                            <td>{{ $cat->status }}</td>
                            <td>
                                <a href="{{ route('admin.mesincuci.edit', encrypt($cat->id)) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.mesincuci.destroy', encrypt($cat->id)) }}" 
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Are you sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No item data available</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <!-- Pagination -->
            @if($data->hasPages())
            <div class="mt-3 d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
                    </small>
                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</x-admin>