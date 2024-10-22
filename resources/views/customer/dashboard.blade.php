@extends('customer.layouts.app')
@section('content')
    {{-- carousel --}}
    <div id="carouselBannerIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselBannerIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselBannerIndicators" data-slide-to="1"></li>
            <li data-target="#carouselBannerIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('banner/ee.jpg') }}" alt="cardamom">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('banner/ff.jpg') }}" alt="pepper">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('banner/hh.jpg') }}" alt="spices">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('banner/ee.jpg') }}" alt="kerala">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('banner/ff.jpg') }}" alt="idukki">
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
   
    <div class="container px-4 text-center">
        <hr>
    </div>
    {{-- Product List --}}
    <div class="container px-4 ">
        <div class="d-flex flex-row mb-5">
            <div class="col p-2">
                <h3 class="text-success font-weight-bold">Top Selling</h3>
            </div>
            <div class="d-flex flex-row-reverse">
                <a href="#" class="btn btn-success cartButton">See More <i class="bi bi-chevron-right"></i></a>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
            <!-- Added mb-4 for row spacing -->
            <div class="col">
                <div class="card h-100 cartButton cartBorder ">
                    <img src="{{ asset('banner/aa.jpg') }}" class="card-img-top  p-2" alt="...">
                    <div class="overlay">
                        <img src="{{ asset('banner/cc.jpg') }}" class="card-img-top  p-2" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Cloth</h5>
                        <p class="card-text">Shirt</p>
                        <p class="card-text">RS.250 &nbsp; <del>RS.500</del></p>
                        <button type="button" class="btn-lg cartButton buttonIcon ">
                            <i class="fa-regular fa-heart icon-1"></i>
                            <i class="fa fa-solid fa-heart icon-2"></i>

                        </button>
                        <a href="#" class="btn btn-success cartButton"><i class="bi bi-cart fs-1"></i>Add to
                            Cart</a>

                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    
   
 


 
@endsection
