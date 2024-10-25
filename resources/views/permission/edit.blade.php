@extends('admin.layouts.app')

@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">Permission</h1>
            <p class="header-subtitle">Permission Status Edit</p>
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
                        <h5 class="card-title mb-0">Permission Edit</h5>
                    </div>

                    <div class="container mt-5">
                        <h2 class="mb-4">Permission Update Form</h2>
                        <form action="{{ route('permission.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="permissions">Assign Permissions</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                    <label class="form-check-label" for="checkAll">Check All</label>
                                </div>
                                <div class="row mt-2">
                                    @foreach ($allPermissions as $index => $permission)
                                        <div class="col-md-3 mb-3"> <!-- Adjust the column size here -->
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input permission-checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->name, $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        </div>

                                        @if (($index + 1) % 4 === 0) <!-- Break the row every 4 checkboxes -->
                                            </div><div class="row">
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Permissions</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('checkAll');
        const checkboxes = document.querySelectorAll('.permission-checkbox');

        // Check/uncheck all checkboxes when "Check All" is toggled
        checkAll.addEventListener('change', function() {
            const isChecked = checkAll.checked; // Get the current state of "Check All"
            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked; // Set the checked status of each checkbox
            });
        });
    });
</script>
@endpush
