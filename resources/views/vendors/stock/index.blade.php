@extends('vendors.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
             Vendor   Stock
            </h1>
            <p class="header-subtitle">Stock List</p>
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
                        <h5 class="card-title mb-0">Stock</h5>
                            <a href="{{ route('vendor.stock.create') }}" class="btn btn-primary">Add Stock</a>

                    </div>
                    <table id="datatables-stocks" class="table table-striped my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none d-xl-table-cell">Product</th>
                                <th class="d-none d-xl-table-cell">Vendor</th>
                                <th class="d-none d-xl-table-cell">Product Price</th>
                                <th class="d-none d-xl-table-cell">Total Stock</th>
                                <th class="d-none d-xl-table-cell">Balance Stock</th>
                                <th class="d-none d-xl-table-cell">Total Stock Price</th>
                                <th class="d-none d-xl-table-cell">Balance Stock Price</th>
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
           $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#datatables-stocks').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('vendor.stock.index') }}',
                type: 'GET',
            },
            columns: [
            { data: null, orderable: false, searchable: false }, // Serial number column
                { data: 'name', name: 'name' },
                { data: 'product.vendor.name', name: 'product.vendor.name' },
                { data: 'product.price', name: 'product.price' },
                { data: 'total_quantity', name: 'total_quantity' },
                { data: 'balance_quantity', name: 'balance_quantity' },
                { data: 'total_quantity_price', name: 'total_quantity_price' },
                { data: 'balance_quantity_price', name: 'balance_quantity_price' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            createdRow: function(row, data, dataIndex) {
            // Set the serial number in the first column
            $('td:eq(0)', row).html(dataIndex + 1); // 1-based index for serial number
        }
        });
    });
    </script>
@endpush