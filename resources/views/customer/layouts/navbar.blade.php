<!-- Just an image -->
<nav class="navbar navbar-light bg-light p-1 ">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('logo/logo.jpg') }}" width="150" height="100" alt="logo">
    </a>
    <div class="m-4">
        <a href="" class="m-4 fs-2 fw-bold">Home</a>
        <div class="dropdown d-inline">
            <a class=" dropdown-toggle m-4 fs-2 fw-bold" id="shopByDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                Shop By
            </a>
            <ul class="dropdown-menu" aria-labelledby="shopByDropdown">
                <li><a class="dropdown-item" href="">All Products</a></li>
            </ul>
        </div>
        
       
    </div>
    <div class="mr-5">
        <button type="button" class="btn buttonHeadIcon"> <i class="bi bi-cart"></i> </button>
        <button type="button" class="btn buttonHeadIcon "> <i class="bi bi-search"></i></button>
        <button type="button" class="btn buttonHeadIcon"> <i class="bi bi-heart heart-icon"></i></button>
        <button type="button" class="btn buttonHeadIcon"> <i class="bi bi-person profile-icon"></i></button>
    </div>

</nav>
