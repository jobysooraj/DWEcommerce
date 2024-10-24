<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="index.html">
        <svg>
            <use xlink:href="#ion-ios-pulse-strong"></use>
        </svg>
        Spark
    </a>
    <div class="sidebar-content">
        <div class="sidebar-user">
            <img src="img/avatars/avatar.jpg" class="img-fluid rounded-circle mb-2" alt="{{ auth()->user()->name }}" />
            <div class="fw-bold">{{ auth()->user()->name }}</div>
            <small>{{ auth()->user()->role }}</small> <!-- Display user role -->
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Main</li>
            <li class="sidebar-item active">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
                </a>
            </li>

            @if(auth()->user()->isAdmin() || auth()->user()->can('view products')) <!-- Check if user is admin or has permission -->
            <li class="sidebar-item">
                <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-file"></i> <span class="align-middle">Products</span>
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('product.index') }}">List</a></li>
                </ul>
            </li>
            @endif

            @if(auth()->user()->isAdmin() || auth()->user()->can('view stock')) <!-- Check if user is admin or has permission -->
            <li class="sidebar-item">
                <a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-flask"></i> <span class="align-middle">Stock</span>
                </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('stock.index') }}">Lists</a></li>
                </ul>
            </li>
            @endif

            <li class="sidebar-header">Elements</li>

            @if(auth()->user()->isAdmin() || auth()->user()->can('view users')) <!-- Check if user is admin or has permission -->
            <li class="sidebar-item">
                <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-user"></i> <span class="align-middle">User</span>
                </a>
                <ul id="users" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('customer.index') }}">Lists</a></li>
                </ul>
            </li>
            @endif

            @if(auth()->user()->isAdmin() || auth()->user()->can('view vendors')) <!-- Check if user is admin or has permission -->
            <li class="sidebar-item">
                <a data-bs-target="#vendors" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-user-tag"></i> <span class="align-middle">Vendor</span>
                </a>
                <ul id="vendors" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('vendor.index') }}">Lists</a></li>
                </ul>
            </li>
            @endif

            @if(auth()->user()->isAdmin() || auth()->user()->can('manage roles & permissions')) <!-- Check if user is admin or has permission -->
            <li class="sidebar-item">
                <a data-bs-target="#roles" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 fas fa-fw fa-user-shield"></i> <span class="align-middle">Role & Permission</span>
                </a>
                <ul id="roles" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('permission.index') }}">List</a></li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</nav>
