@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
             Vendor   Stock
            </h1>
            <p class="header-subtitle">Stock Edit List</p>
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
                        <h5 class="card-title mb-0">Stocks</h5>

                        <div class="container mt-5">
                            <h2 class="mb-4">Stock Update Form</h2>
                            <form action="{{ route('vendor.stock.update', $stock->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="product" class="form-label">Name</label>
                                    <select class="form-control" id="product_id" name="product_id">
                                    <option value="#">Choose One</option>
                                        @foreach($products as $key => $product)
                                        <option value="{{$product->id}}" {{ $stock->product_id == $product->id ? 'selected' : '' }}>
                                            {{$product->name}}
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Total Quantity</label>
                                    <input type="number" class="form-control" id="total_quantity"  value="{{$stock->total_quantity}}" name="total_quantity" placeholder="Enter your Quantity number" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">update</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</main>
@endsection
