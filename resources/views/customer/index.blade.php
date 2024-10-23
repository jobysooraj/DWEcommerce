@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Customer
            </h1>
            <p class="header-subtitle">Customer List</p>
        </div>

      
 @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
       
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
                       

                    </div>
                    <table id="datatables-dashboard-products" class="table table-striped my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none d-xl-table-cell">Name</th>
                                <th class="d-none d-xl-table-cell">email</th>
                                <th class="d-none d-xl-table-cell">phone</th>
                                <th class="d-none d-xl-table-cell">Status</th>
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
@push('script')

    <script>
       $(document).ready(function() {
    $('#datatables-dashboard-products').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('customer.index') }}', // URL to fetch data
            type: 'GET',
        },
        columns: [
            { data: null, orderable: false, searchable: false }, // Serial number column

            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
         createdRow: function(row, data, dataIndex) {
            // Set the serial number in the first column
            $('td:eq(0)', row).html(dataIndex + 1); // 1-based index for serial number
        }
        // Additional configuration options can go here
    });
});

    </script>
@endpush