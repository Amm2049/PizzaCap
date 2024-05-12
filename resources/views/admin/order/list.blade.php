@extends('admin.master')

@section('title', 'Admin Catagory List Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left w-100 d-flex justify-content-between">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                            <div class="d-flex">
                                <label class="form-label mr-4 pt-2 text-info">Status</label>
                                <select id="status" class="form-control w-75">
                                    <option value="all">All</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Success</option>
                                    <option value="2">Reject</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <td>User ID</td>
                                    <td>User Name</td>
                                    <td>Amount</td>
                                    <td>Order Code</td>
                                    <td>Date</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orders as $order)
                                    <tr class="tr-shadow">
                                        <input type="hidden" id="orderId" value="{{ $order->id }}">
                                        <td>{{ $order->user_id }}</td>
                                        <td>{{ $order->user_name }}</td>
                                        <td>{{ $order->total_price }} Kyats</td>
                                        <td class="text-info">
                                            <a href="{{ route('ajax#detailOrder', $order->order_code) }}">
                                                {{ $order->order_code }}
                                            </a>
                                        </td>
                                        <td>{{ $order->created_at->format('j-F-Y') }}</td>
                                        <td class="col-2">
                                            <select class="form-control changeStatus">
                                                <option value="0" @if ($order->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($order->status == 1) selected @endif>
                                                    Success</option>
                                                <option value="2" @if ($order->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection

@section('scriptSection')
    <script>
        $(document).ready(function() {

            $('#status').change(function() {
                $status = $('#status').val();

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8001/order/ajax/sortOrder',
                    data: {
                        'status': $status
                    },
                    dataType: 'json',
                    success: function(response) {
                        $list = '';
                        for ($i = 0; $i < response.length; $i++) {

                            // Date
                            $month = ['January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November',
                                'December'
                            ];
                            $dbDate = new Date(response[$i].created_at);
                            $date = $month[$dbDate.getMonth()] + '-' + $dbDate.getDate() + '-' +
                                $dbDate.getFullYear();

                            // Status
                            if (response[$i].status == 0) {
                                $statusMessage =
                                    `
                                <select class="form-control changeStatus">
                                    <option value="0" selected>
                                        Pending</option>
                                    <option value="1">
                                        Success</option>
                                    <option value="2">
                                        Reject</option>
                                </select>
                            `
                            } else if (response[$i].status == 1) {
                                $statusMessage =
                                    `
                                <select class="form-control changeStatus">
                                    <option value="0">
                                        Pending</option>
                                    <option value="1" selected>
                                        Success</option>
                                    <option value="2">
                                        Reject</option>
                                </select>
                            `
                            } else if (response[$i].status == 2) {
                                $statusMessage =
                                    `
                                <select class="form-control changeStatus">
                                    <option value="0">
                                        Pending</option>
                                    <option value="1">
                                        Success</option>
                                    <option value="2" selected>
                                        Reject</option>
                                </select>
                            `
                            }

                            $list +=
                                `
                                <tr class="tr-shadow">
                                    <input type="hidden" id="orderId" value=" ${response[$i].id} ">
                                    <td> ${ response[$i].user_id } </td>
                                    <td> ${ response[$i].user_name } </td>
                                    <td> ${ response[$i].total_price } Kyats</td>
                                    <td>
                                        <a href=" route('ajax#detailOrder', ${response[$i].order_code})">
                                            ${ response[$i].order_code }
                                        </a>
                                    </td>
                                    <td> ${ $date } </td>
                                    <td class="col-2"> ${ $statusMessage } </td>
                                </tr>
                                <tr class="spacer"></tr>
                            `
                        }
                        $('#dataList').html($list);

                        $('.changeStatus').change(function() {
                            $parentNode = $(this).parents('tr');
                            $status = $parentNode.find('.changeStatus').val();
                            $orderId = $parentNode.find('#orderId').val();

                            $.ajax({
                                type: 'get',
                                url: 'http://127.0.0.1:8001/order/ajax/changeOrder',
                                data: {
                                    'orderId': $orderId,
                                    'status': $status
                                },
                                dataType: 'json'
                            })
                        })
                    }
                })
            })

            $('.changeStatus').change(function() {
                $parentNode = $(this).parents('tr');
                $status = $parentNode.find('.changeStatus').val();
                $orderId = $parentNode.find('#orderId').val();

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8001/order/ajax/changeOrder',
                    data: {
                        'orderId': $orderId,
                        'status': $status
                    },
                    dataType: 'json'
                })
            })
        })
    </script>
@endsection
