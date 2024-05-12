@extends('admin.master')

@section('title', 'Order Info Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="col-3">
                                <a href="{{ route('order#listPage') }}"><button style="background-color: black" class="btn text-white my-3">Back to previous page</button></a>
                            </div>
                            <div class="overview-wrap">

                                <div class="col-lg-12 p-3 ml-4">
                                    <h3 class="section-title position-relative text-uppercase mb-3"><span class="pr-3"><i class="fa-solid fa-file-invoice mr-3"></i>Order Info</span></h3>
                                    <div class="bg-light d-flex pt-4"  style="height:100%; width:100%">
                                        <div class="pl-5">
                                            <h4 class="mb-4"><i class="fa-solid fa-user mr-3"></i>Name</h4>
                                            <h4 class="mb-4"><i class="fa-solid fa-barcode mr-3"></i>Order Code</h4>
                                            <h4 class=""><i class="fa-solid fa-hand-holding-dollar mr-3"></i>Total Price</h4>
                                            <p class="py-3 text-info">Delivery Charge is also included !</p>
                                        </div>
                                        <div class="pl-5">
                                            <h4 class="mb-4">{{ $orderList[0]->user_name }}</h4>
                                            <h4 class="mb-4">{{ $order->order_code }}</h4>
                                            <h4>{{ $order->total_price }} Kyats</h4>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row px-xl-5">
                        <div class="col-lg-12 table-responsive mb-5">
                            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                                <thead class="text-white" style="background-color: black">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Image</th>

                                        <th>Product Name</th>
                                        <th>Order Date</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @foreach ($orderList as $o)
                                        <tr>
                                            <td class="align-middle"> {{ $o->id }}</td>
                                            <td class="align-middle text-left"><img
                                                    src="{{ asset('storage/' . $o->pizza_image) }}"
                                                    style="width: 80px; height:70px"></td>

                                            <td class="align-middle">{{ $o->pizza_name }}</td>
                                            <td class="align-middle">{{ $o->created_at->format('j-F-Y') }}</td>
                                            <td class="align-middle">{{ $o->quantity }}</td>
                                            <td class="align-middle">{{ $o->total }} Kyats</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
