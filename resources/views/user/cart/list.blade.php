@extends('user.master')

@section('content')
    <a href="{{ route('user#homePage') }}">
        <button class="mb-3 ml-4 btn btn-sm text-white px-3 py-2 rounded" style="background-color: black">Back to
            previous page</button>
    </a>
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="text-white" style="background-color: black">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $cartItem)
                            <tr>
                                <td class="align-middle text-left"><img
                                        src="{{ asset('storage/' . $cartItem->pizza_image) }}" class=""
                                        style="width: 80px"></td>
                                <td class="align-middle"> {{ $cartItem->pizza_name }}
                                    <input type="hidden" id="cartId" value="{{ $cartItem->id }}">
                                    <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                                    <input type="hidden" id="productId" value="{{ $cartItem->product_id }}">
                                </td>
                                <td class="align-middle" id="price">{{ $cartItem->pizza_price }} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="quantity"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $cartItem->quantity }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-3" id="total">
                                    {{ $cartItem->pizza_price * $cartItem->quantity }}
                                    Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btnRemove btn-danger"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal">{{ $totalPrice + 3000 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 pay">Proceed To
                            Checkout</button>
                        <button id="clearCartBtn" class="btn text-white btn-block font-weight-bold my-3 py-3"
                            style="background-color: rgb(255, 33, 33)">Clear Cart Items</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        $('.pay').click(function() {

            // $totalPrice = 0;
            $orderList = [];

            $random = Math.floor(Math.random() * 100001);

            $('#dataTable tbody tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('#userId').val(),
                    'product_id': $(row).find('#productId').val(),
                    'quantity': $(row).find('#quantity').val(),
                    'total': $(row).find('#total').text().replace('Kyats', '') * 1,
                    'order_code': 'POS' + $random
                })
            })

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8001/user/ajax/order',
                data: Object.assign({}, $orderList), // Must be Object type
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.href = 'http://127.0.0.1:8001/user/homePage';
                    }
                }
            })
        })

        $('#clearCartBtn').click(function() {
            $('#dataTable tbody tr').remove();
            $('#subTotal').html('0 Kyats');
            $('#finalTotal').html('3000 Kyats');

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8001/user/ajax/clearCart',
                dataType: 'json'
            })
        })

        // Remove Row
        $('.btnRemove').click(function() {
            $parentNode = $(this).parents("tr");
            $parentNode.remove();
            summaryCalculation()

            $productId = $parentNode.find('#productId').val();
            $cartId = $parentNode.find('#cartId').val();

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8001/user/ajax/clearCartItem',
                data: {
                    'productId': $productId , 'cartId' : $cartId
                },
                dataType: 'json'
            })
        })

        // Summary Total
        function summaryCalculation() {
            $totalPrice = 0;
            $('#dataTable tbody tr').each(function(index, row) {
                $totalPrice += Number($(row).find('#total').text().replace("Kyats", ""));
            })

            $('#subTotal').html(`${$totalPrice} Kyats`);
            $('#finalTotal').html(`${$totalPrice + 3000} Kyats`);
        }
    </script>
@endsection
