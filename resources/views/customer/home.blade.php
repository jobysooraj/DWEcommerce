@extends('customer.layouts.app')

<style>
    .spacing {
        letter-spacing: -1px;
    }
</style>

@section('content')
{{-- Carousel --}}
<div id="carouselBannerIndicators" class="carousel slide h-50" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselBannerIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselBannerIndicators" data-slide-to="1"></li>
        <li data-target="#carouselBannerIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('banner/aa.jfif') }}" alt="cardamom">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('banner/bb.jfif') }}" alt="pepper">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('banner/cc.jfif') }}" alt="spices">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('banner/cc.jfif') }}" alt="kerala">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('banner/cc.jfif') }}" alt="idukki">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselBannerIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselBannerIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>



{{-- Product List --}}
<div class="container px-4 m-5">
    <div class="d-flex flex-row mb-5">
        <div class="col p-2">
            <h3 class="text-success font-weight-bold">Top Selling</h3>
        </div>
        <div class="d-flex flex-row-reverse">
            <a href="#" class="btn btn-success">See More <i class="bi bi-chevron-right"></i></a>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <!-- Displaying products -->
        @foreach ($products as $product)
        <div class="col">
            <div class="card h-100 cartBorder cartButton">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top p-2" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">RS.{{ $product->price }} &nbsp; <del>RS.{{ $product->old_price }}</del></p>
                    <button type="button" class="btn-lg buttonIcon">
                        <i class="fa-regular fa-heart icon-1"></i>
                        <i class="fa fa-solid fa-heart icon-2"></i>
                    </button>
                    <a href="#" class="btn btn-success addToCartButton" data-product-id="{{ $product->id }}">
                        <i class="bi bi-cart fs-1"></i>Add to Cart
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('.addToCartButton').on('click', function(e) {
            e.preventDefault();

            var productId = $(this).data('product-id');

            $.ajax({
                url: "{{ route('cart.store') }}", // Adjust this URL to your API endpoint
                type: 'POST',
                data: {
                    product_id: productId,                    
                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                },
                success: function(response) {                 
                    // console.log(response.cartCount);
                     $("#cartCount").text(response.cartCount)
                    alert('Product added to cart successfully!');
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while adding the product to the cart.');
                }
            });
        });
    });
</script>
@endpush
