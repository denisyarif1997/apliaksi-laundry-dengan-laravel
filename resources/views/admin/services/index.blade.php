<x-admin>
    @section('title','Layanan List')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Layanan Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="servicesTable">
                <thead>
                    <tr>
                        <th>Layanan</th>
                        <th>Harga per KG</th>
                        <th>Estimasi Waktu</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $cat)
                        <tr>
                            <td>{{ $cat->nama_layanan }}</td>
                            <td>{{ $cat->harga_per_kg }}</td>
                            <td>{{ $cat->estimasi_waktu }}</td>
                            <td><a href="{{ route('admin.services.edit', encrypt($cat->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.services.destroy', encrypt($cat->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @section('js')
        <script>
            $(function() {
                $('#servicesTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
