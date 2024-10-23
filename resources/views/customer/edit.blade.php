@extends('admin.layouts.app')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Customer
            </h1>
            <p class="header-subtitle">Customer Status Edit</p>
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
                        <h5 class="card-title mb-0">Customer Status Edit</h5>
                        <div class="container mt-5">
                            <h2 class="mb-4">Customer Status Update Form</h2>
                            <form method="POST" action="{{ route('customer.update', $customer->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select One</option>
                                        <option value="active" {{ $customer->status === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $customer->status === 'inactive' ? 'selected' : '' }}>In-active</option>
                                    </select>
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
