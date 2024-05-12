@extends('user.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <input type="hidden" id="pizzaId" value="{{ $pizzaChosen->id }}">
            <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $pizzaChosen->image) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">

                <div class="h-100 bg-light p-30">
                    <div class="d-flex justify-content-between">
                        <h3>{{ $pizzaChosen->name }}</h3>
                        <a href="{{ route('user#homePage') }}">
                            <button class="mb-1 btn btn-sm text-white px-3 py-2" style="background-color: black">Back to
                                previous page</button>
                        </a>
                    </div>
                    <div class="d-flex mb-3">

                        <h6 class="pt-1"><i class="fa-solid fa-eye mr-1"></i> {{ $pizzaChosen->view_count + 1 }} Views</h6>
                        <div class="text-primary ml-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4"><i class="fa-solid fa-money-bill-1-wave"></i>
                        {{ $pizzaChosen->price }} Kyats</h3>
                    <p class="mb-4">{{ $pizzaChosen->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" id="orderCount"
                                value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button id="addCartBtn" type="button" class="btn btn-primary px-3"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid">
        <h3 class=" section-title position-relative mx-xl-5 mb-5"><span style="background-color: black;color: yellow"
                class="py-2 px-2 pr-3">You May
                Also Like</span></h3>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaAll as $pizzas)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $pizzas->image) }}"
                                    style="height: 250px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $pizzaChosen->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $pizzaChosen->price }}</h5>
                                    <h6 class="text-muted ml-2"><del>{{ $pizzaChosen->price }}</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            // View Count
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8001/user/ajax/viewCount',
                data: {
                    'pizzaId': $('#pizzaId').val()
                },
                dataType: 'json',
            })

            // Add Cart
            $('#addCartBtn').click(function() {
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8001/user/ajax/addCart',
                    data: {
                        'userId': $('#userId').val(),
                        'pizzaId': $('#pizzaId').val(),
                        'count': $('#orderCount').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = 'http://127.0.0.1:8001/user/homePage';
                        }
                    }
                })
            })
        })
    </script>
@endsection
