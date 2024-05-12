@extends('user.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by price</span></h5>
                <div class="bg-light p-4 mb-30 p-5">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <label class="" for="price-all" style="color:black">Catagories</label>
                            <span class="badge border font-weight-normal">{{ count($catagories) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#homePage') }}">
                                <label class="" for="price-1" style="color:black">All</label>
                            </a>
                        </div>
                        @foreach ($catagories as $catagory)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('user#filter', $catagory->id) }}">
                                    <label class="" for="price-1" style="color:black">{{ $catagory->name }}</label>
                                </a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartListPage') }}" class="mr-3">
                                    <button style="background-color: black" type="button"
                                        class="btn rounded text-warning py-2 position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i> Cart Items
                                        <span style="color: rgb(255, 255, 255); background-color:rgb(255, 0, 0)"
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                                            {{ count($cart) }}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('user#ordersPage') }}">
                                    <button style="background-color: black" type="button"
                                        class="btn rounded text-warning py-2 position-relative">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Ordered Items
                                        <span style="color: rgb(255, 255, 255); background-color:rgb(255, 0, 0)"
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                                            {{ count($orders) }}
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button> --}}
                                    <select class="form-control" name="sortingName" id="sortingId">
                                        <option value="">Choose option ...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                    {{-- <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ml-4" id="dataList">
                        @foreach ($pizzas as $pizza)
                            @if (count($pizzas) <= 3)
                                <div style="width: 363px" class="ml-3 mr-3 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $pizza->image) }}"
                                                style="height:250px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#cartListPage') }}"><i
                                                        class="fa-solid fa-cart-shopping"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetail', $pizza->id) }}"><i
                                                        class="far fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $pizza->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $pizza->price }} Kyats</h5>
                                            </div>
                                            {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @elseif (count($pizzas) > 3)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $pizza->image) }}"
                                                style="height:250px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#cartListPage') }}"><i
                                                        class="fa-solid fa-cart-shopping"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetail', $pizza->id) }}"><i
                                                        class="far fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $pizza->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $pizza->price }} Kyats</h5>
                                            </div>
                                            {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
        <!-- Shop End -->
    @endsection

    @section('scriptSource')
        <script>
            $(document).ready(function() {
                $('#sortingId').change(function() {
                    $eventOption = $('#sortingId').val();

                    if ($eventOption == 'asc') {
                        $.ajax({
                            type: 'get',
                            url: 'http://127.0.0.1:8001/user/ajax/pizzaSorting',
                            data: {
                                'status': 'asc'
                            },
                            dataType: 'json',
                            success: function(response) {
                                $list = '';
                                for ($i = 0; $i < response.length; $i++) {
                                    $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                                    style="height:250px;">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                            class="fa-solid fa-cart-shopping"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                            class="far fa-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate"
                                                    href="">${response[$i].name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${response[$i].price} Kyats</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `;
                                }
                                $('#dataList').html($list);
                            }
                        })
                    } else if ($eventOption == 'desc') {
                        $.ajax({
                            type: 'get',
                            url: 'http://127.0.0.1:8001/user/ajax/pizzaSorting',
                            data: {
                                'status': 'desc'
                            },
                            dataType: 'json',
                            success: function(response) {
                                $list = '';
                                for ($i = 0; $i < response.length; $i++) {
                                    $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                                    style="height:250px;">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                            class="fa-solid fa-cart-shopping"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                            class="far fa-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate"
                                                    href="">${response[$i].name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${response[$i].price} Kyats</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `;
                                }
                                $('#dataList').html($list);
                            }
                        })
                    }
                })
            })
        </script>
    @endsection
