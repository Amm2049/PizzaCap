@extends('admin.master')

@section('title', 'Admin Catagory List Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool d-flex align-items-center">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>
                            </div>
                        </div>
                        <form action="{{ route('product#listPage') }}" method="get" class="ms-5">
                            @csrf
                            <div class="d-flex">
                                <input class="form-control" value="{{ request('key') }}" placeholder="Search ..."
                                    name="key">
                                <button type="submit" style="background-color: rgb(148, 254, 99)" class="btn text-black"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add new product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    @if (count($pizzas) != 0)
                        {{-- <div class="m-2">
                            <div class="row d-flex flex-wrap">
                                @foreach ($pizzas as $pizza)
                                    <div class="mt-4 mx-3 card" style="flex: 0 0 calc(45%);">
                                        <div class="caption p-4" style="height:200px;">
                                            <div class="row px-3 justify-content-between">
                                                <h4 class="mb-2">{{ $pizza->name }}</h4>
                                                <div>
                                                    <a href="{{ route('product#view', $pizza->id) }}">
                                                        <i class="fa-solid fa-eye text-info"></i>
                                                    </a>
                                                    <a href="{{ route('product#updatePage', $pizza->id) }}">
                                                        <i class="fa-solid fa-square-pen text-success"></i>
                                                    </a>

                                                    <a href="{{ route('product#delete', $pizza->id) }}">
                                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <p class="text-justify text-muted mb-2">{{ $pizza->description }}</p>
                                            <div class="d-flex">
                                                <small style="color: rgb(0, 0, 0)"><i
                                                        class="fa-solid fa-eye text-dark"></i>&nbsp{{ $pizza->view_count }}&nbsp;view</small>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <small style="color: rgb(0, 0, 0)"><i
                                                        class="fa-solid fa-money-bill-1-wave text-dark">&nbsp;</i>{{ $pizza->price }}&nbsp;kyats</small>
                                                &nbsp;&nbsp;
                                                <small style="color: rgb(0, 0, 0)"><i
                                                        class="fa-solid fa-business-time"></i>{{ $pizza->waiting_time }}&nbsp;Minutes</small>&nbsp;&nbsp;
                                                <small style="color: rgb(0, 255, 0)"><i
                                                        class="fa-solid fa-magnifying-glass-chart"></i>{{ $pizza->catagory_name }}&nbsp;</small>
                                            </div>
                                        </div>
                                        <div class="preview image-box">
                                            <img style="width:100%;height:250px;"
                                                src="{{ asset('storage/' . $pizza->image) }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Waiting Time</th>
                                        <th>View</th>
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $pizza)
                                        <tr class="tr-shadow">
                                            <td class="col-2">
                                                <img style="height:100px;" src="{{ asset('storage/' . $pizza->image) }}">
                                            </td>
                                            <td>{{ $pizza->name }}</td>
                                            <td>{{ $pizza->price }} Kyats</td>
                                            <td>{{ $pizza->waiting_time }} minutes</td>
                                            <td>{{ $pizza->view_count }}</td>
                                            <td>{{ $pizza->catagory_name }}</td>
                                            <td>
                                                <a href="{{ route('product#view', $pizza->id) }}">
                                                    <button class="item mx-2" style="font-size: 20px" data-toggle="tooltip"
                                                        data-placement="top" title="View">
                                                        <i class="fa-solid fa-eye text-info"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#updatePage', $pizza->id) }}">
                                                    <button class="item mx-2" style="font-size: 20px" data-toggle="tooltip"
                                                        data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-square-pen text-success"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#delete', $pizza->id) }}">
                                                    <button class="item mx-2" style="font-size: 20px" data-toggle="tooltip"
                                                        data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $pizzas->links() }}
                        </div>
                    @else
                        <h3 class="text-muted text-center p-5">There is no data here.</h3>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
