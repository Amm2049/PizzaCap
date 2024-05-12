@extends('admin.master')

@section('title', 'Report Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('user#servicePage') }}"><button style="background-color: black"
                                class="btn text-white my-3 w-100">Back to previous page</button></a>
                    </div>
                </div>
                <div class="col-lg-8 offset-2">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Customer Service</h3>
                            </div>
                            <hr>

                            <form action="{{ route('user#reply',$contact->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6 pl-5">
                                        <h4 class="mb-4 mt-4">Name</h4>
                                        <h4 class="mb-4 mt-4">Email</h4>
                                        <h4 class="mb-4">Report Message</h4>
                                    </div>
                                    <div class="col-6 pr-5">
                                        <h4 class="mb-4 mt-4">{{ $contact->name }}</h4>
                                        <h4 class="mb-4 mt-4">{{ $contact->email }}</h4>
                                        <p class="mb-4">{{ $contact->message }}</p>
                                    </div>
                                    <div class="col-6 pl-5 mb-4 mt-4">
                                        <h4 class="">Reply Back ...</h4>

                                    </div>
                                    <div class="col-6 p-0">
                                        @if (session('success'))
                                        <div class="col-12">
                                            <div class="alert alert-success" role="alert">
                                                <i class="fa-solid fa-thumbs-up"></i> {{ session('success') }}
                                            </div>
                                        </div>
                                    @endif
                                    @error('reply')
                                    <div class="col-11">
                                        <div class="alert alert-danger" role="alert">
                                            <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                                        </div>
                                    </div>
                                    @enderror
                                    </div>
                                    <div class="col-10  ml-5 card" style="background-color: rgb(255, 246, 213)">
                                        <textarea name="reply" style="background-color: rgb(255, 246, 213)" class="p-3 text-black @error('reply')
                                            is-invalid
                                        @enderror" cols="10" rows="5" placeholder="Enter your message here ..."></textarea>
                                    </div>
                                    <button style="background-color: black" type="submit" class="btn ml-5 p-2 col-2 text-warning replyBtn">Submit<i class="fa-solid fa-square-up-right ml-2"></i></button>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
