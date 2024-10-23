@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
             Vendor   Product
            </h1>
            <p class="header-subtitle">Product Edit</p>
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
                        <h5 class="card-title mb-0">Product</h5>

                        <div class="container mt-5">
                            <h2 class="mb-4">Product Edit Form</h2>
                            <form action="{{ route('vendor.product.update', $product->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value={{$product->name}} placeholder="Enter your name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="vendor" class="form-label">vendor</label>

                                    <select class="form-control" id="vendor_id" name="vendor_id">
                                        {{-- <option value="#">Choose One</option> --}}
                                        {{-- @foreach($vendors as $key => $vendor) --}}
                                        <option value="{{$vendor->id}}" {{ $product->vendor_id == $vendor->id ? 'selected' : '' }}>
                                            {{$vendor->name}}
                                        </option>
                                        {{-- @endforeach --}}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}" placeholder="Enter your price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Your description here" required>{{$product->description}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</main>
@endsection
