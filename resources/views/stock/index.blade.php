@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Stock
            </h1>
            <p class="header-subtitle">Stock List</p>
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
                        <h5 class="card-title mb-0">Stock</h5>
                            <a href="{{ route('stock.create') }}" class="btn btn-primary">Add Stock</a>

                    </div>
                    <table id="datatables-dashboard-products" class="table table-striped my-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="d-none d-xl-table-cell">Vendor</th>
                                <th class="d-none d-xl-table-cell">Product</th>
                                <th class="d-none d-xl-table-cell">Product Price</th>
                                <th class="d-none d-xl-table-cell">Total Stock</th>
                                <th class="d-none d-xl-table-cell">Balance Stock</th>
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
@section('scripts')

    <script>
       $(document).ready(function() {
           $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#datatables-dashboard-products').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('stock.index') }}',
                type: 'GET',
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'product.vendor.name', name: 'product.vendor.name' },
                { data: 'product.price', name: 'product.price' },
                { data: 'total_stock', name: 'total_stock' },
                { data: 'balance_stock', name: 'balance_stock' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });
    });
    </script>
@endsection