@extends('user.master')

@section('content')
    <a href="{{ route('user#homePage') }}">
        <button class="mb-3 ml-4 btn btn-sm text-white px-3 py-2 rounded" style="background-color: black">Back to
            previous page</button>
    </a>
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="text-white" style="background-color: black">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orders as $order)
                            <tr class="align-middle">
                                <td>{{ $order->created_at->format('j-F-Y') }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>
                                    @if ( $order->status == 0)
                                        <i class="fa-solid fa-clock-rotate-left text-info"></i><span class="text-info ml-2">Pending ...</span>
                                    @elseif ( $order->status == 1)
                                        <i class="fa-solid fa-circle-check text-success"></i><span class="text-success ml-2">Success ...</span>
                                    @elseif ( $order->status == 2)
                                        <i class="fa-solid fa-rectangle-xmark text-danger"></i><span class="text-danger ml-2">Reject ...</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection
