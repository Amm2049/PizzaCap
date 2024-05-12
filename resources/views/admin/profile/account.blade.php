@extends('admin.master')

@section('title', 'Category Create Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('catagory#list') }}"><button class="btn text-white my-3 w-100" style="background-color: black">Back to previous page</button></a>
                    </div>
                </div>
                <div class="col-lg-8 offset-2">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account View</h3>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around align-content-center">
                                <div class="w-50 m-3">
                                    @if (Auth::user()->image == null)
                                        <img class="img-thumbnail" style="height:100%;"
                                            src="{{ asset('image/default.jpeg') }}">
                                    @else
                                        <img class="img-thumbnail" style="height:100%;"
                                            src="{{ asset('storage/' . Auth::user()->image) }}">
                                    @endif
                                </div>
                                <div class="w-100 text-align-center pt-4 mt-4 mx-3">
                                    <div>
                                        <h5 class="mb-3"><i class="fa-solid fa-user-tie fa-1x"></i> &nbsp;&nbsp;&nbsp;
                                            {{ Auth::user()->name }} </h5>
                                        <h5 class="mb-3"><i class="fa-solid fa-envelope-circle-check fa-1x"></i> &nbsp;
                                            {{ Auth::user()->email }} </h5>
                                        <h5 class="mb-3"><i class="fa-solid fa-phone-volume fa-1x"></i> &nbsp;&nbsp;
                                            {{ Auth::user()->phone }} </h5>
                                        <h5 class="mb-3"><i class="fa-solid fa-location-dot"></i> &nbsp;&nbsp;&nbsp;
                                            {{ Auth::user()->address }} </h5>
                                        <h5 class="mb-3"><i class="fa-solid fa-venus-mars"></i> &nbsp;
                                            {{ Auth::user()->gender }} </h5>
                                        <h5 class="mb-3"><i class="fa-regular fa-calendar-days fa-1x"></i>
                                            &nbsp;&nbsp;&nbsp; {{ Auth::user()->created_at->format('j-F-Y') }} </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('admin#editAccountPage') }}" class=" w-50">
                                    <div class="text-center p-2 m-2 ">
                                        <button type="submit" style="background-color: black" class="text-white btn w-100 text-center">Edit</button>
                                    </div>
                                </a>
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
