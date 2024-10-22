@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Vendor
            </h1>
            <p class="header-subtitle">Vendor List</p>
        </div>

      

       
        <div class="row">
            <div class="col-12 col-lg-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="card-actions float-end">
                            <a href="#" class="me-1">
                                <i class="align-middle" data-feather="refresh-cw"></i>
                            </a>
                            <div class="d-inline-block dropdown show">
                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                    <i class="align-middle" data-feather="more-vertical"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Vendors</h5>
                            <a href="{{ route('admin.vendor.create') }}" class="btn btn-primary">Add Vendor</a>

                    </div>
                    <table id="datatables-dashboard-vendors" class="table table-striped my-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="d-none d-xl-table-cell">Mobile</th>
                                <th class="d-none d-xl-table-cell">Email</th>
                                <th class="d-none d-xl-table-cell">Address</th>
                                <th class="d-none d-xl-table-cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
            </div>
          
        </div>

    </div>
</main>
@endsection
@section('scripts')

    <script>
       $(document).ready(function() {
    $('#datatables-dashboard-vendors').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.vendor.index') }}', // URL to fetch data
            type: 'GET',
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'email', name: 'email' },
            { data: 'address', name: 'address' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        // Additional configuration options can go here
    });
});

    </script>
@endsection