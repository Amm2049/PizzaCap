@extends('admin.master')

@section('title', 'Category Create Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 offset-8">
                        <button class="btn btn-dark text-white my-3" onclick="history.back()">Back to previous page</button>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza View</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="w-100 col-6">
                                    <img class="" style="height:100%;"src="{{asset('storage/'.$pizza->image)}}">
                                </div>
                                <div class="w-100 col-6">
                                    <div>
                                        <h4 class="my-4">
                                            {{ $pizza->name }} </h4>
                                        <h5 class="mb-3 btn btn-sm" style="background-color: black; color:white"><i class="fa-regular fa-money-bill-1"></i>
                                            &nbsp;&nbsp;
                                            {{ $pizza->price }} </h5>
                                        <h5 class="mb-3 btn btn-sm" style="background-color: black; color:white"><i class="fa-solid fa-eye"></i>
                                            &nbsp;&nbsp;&nbsp;
                                            {{ $pizza->view_count }} </h5>
                                        <h5 class="mb-3 btn btn-sm" style="background-color: black; color:white"><i class="fa-solid fa-clock"></i> &nbsp;
                                            {{ $pizza->waiting_time }} </h5>
                                        <h5 class="mb-3 btn btn-sm" style="background-color: black; color:white"><i
                                                class="fa-regular fa-calendar-days fa-1x"></i>
                                            &nbsp;&nbsp;&nbsp; {{ $pizza->created_at->format('j-F-Y') }} </h5>
                                        <h5 class="mb-3 btn btn-sm col" style="background-color: black; color:white"><i class="fa-solid fa-magnifying-glass-chart"></i>
                                                &nbsp;
                                                {{$pizza->catagory_name}} </h5>
                                        <h5 class="mb-3 btn btn-sm" style="background-color: black; color:white"><i class="fa-solid fa-note-sticky"></i>
                                            &nbsp;
                                            Description </h5>
                                        <p class="text-muted">{{ $pizza->description }}</p>
                                        <a href="{{route('product#updatePage',$pizza->id)}}">
                                            <button class="btn text-white my-3" style="background-color: black; color:white">Edit Product</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
