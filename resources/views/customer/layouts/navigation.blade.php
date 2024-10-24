<!-- Just an image -->
<nav class="navbar navbar-light bg-light p-1 ">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('logo/logo.jpg') }}" width="150" height="100" alt="">
    </a>
    <div class="m-4">
        <a href="{{ route('home.index') }}" class="m-4 fs-2 fw-bold">Home</a>
    </div>
    <div class="mr-5">
        <a href="{{ route('cart.index') }}">
            <button type="button" class="btn buttonHeadIcon"> <i class="bi bi-cart"></i>
                @if ($cartItemCount > 0)
                    <span id="cartCount" class="badge badge-danger">{{ $cartItemCount }}</span>
                @endif
            </button></a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a class="btn buttonHeadIcon" href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i>Sign out</a>
        {{-- <a href="{{ route('login') }}"> <button type="button" class="btn buttonHeadIcon"> <i class="bi bi-people profile-icon"></i></button></a>
        <a href="{{ route('register') }}"> <button type="button" class="btn buttonHeadIcon"> <i class="bi bi-person profile-icon"></i></button></a> --}}
    </div>

</nav>
