<!-- Just an image -->
<nav class="navbar navbar-light bg-light p-1 ">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('logo/logo.jpg') }}" width="150" height="100" alt="">
    </a>
    <div class="m-4">
        <a href="" class="m-4 fs-2 fw-bold">Home</a>
        <a href="" class="m-4 fs-2 fw-bold">Shop By</a>
        <a href="" class="m-4 fs-2 fw-bold">Combo & Gifts</a>
        <a href="" class="m-4 fs-2 fw-bold">Bulk Orders</a>
        <a href="" class="m-4 fs-2 fw-bold">Our Story</a>
        <a href="" class="m-4 fs-2 fw-bold">Blog</a>
        <a href="" class="m-4 fs-2 fw-bold">Contact</a>
    </div>
    <div class="mr-5">
       <a href="#"><button type="button" class="btn buttonHeadIcon"> <i class="bi bi-cart"></i> </button></a>

        <a href="{{ route('login') }}"> <button type="button" class="btn buttonHeadIcon"> <i class="bi bi-people profile-icon"></i></button></a>
        <a href="{{ route('register') }}"> <button type="button" class="btn buttonHeadIcon"> <i class="bi bi-person profile-icon"></i></button></a>
    </div>

</nav>
