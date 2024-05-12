@extends('user.master')

@section('content')
    {{-- Contact Section --}}

    <div class="w-100">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="row">
                    <div class="mt-3 mb-5 col-4  offset-1">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Contact Page</h3>
                                </div>
                                <hr>
                                @if (session('success'))
                                    <div class="mb-3 px-3 pt-2">
                                        <div class="alert alert-success" role="alert">
                                            <i class="fa-solid fa-thumbs-up"></i> {{ session('success') }}
                                        </div>
                                    </div>
                                @endif
                                <form action="{{ route('user#contact') }}" method="post" class="p-2">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Name</label>
                                            <input name="name" value="{{ old('name') }}"
                                                placeholder="Enter your name ..."
                                                class="@error('name') is-invalid @enderror form-control">
                                            @error('name')
                                                <small class="d-inline invalid-feedback">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Name</label>
                                            <input name="email" value="{{ old('email') }}"
                                                placeholder="Enter your email ..."
                                                class="@error('email') is-invalid @enderror form-control">
                                            @error('email')
                                                <small class="d-inline invalid-feedback">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label">Name</label>
                                        <textarea rows="6" type="text" name="message" value="{{ old('message') }}" placeholder="Enter your message ..."
                                            class="@error('message') is-invalid @enderror w-100 form-control"></textarea>
                                        @error('message')
                                            <small class="d-inline invalid-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-dark mb-2 p-3">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 mb-5 pb-3 col-4 offset-2" style="background-color: black; height:100%">
                        <div class="card shadow" style="background-color: black">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center text-white title-2">Contact Page</h3>
                                </div>
                                <hr>
                                <div id="parent" class="mt-4">
                                    <div class="container1 mb-4">

                                        <img class="" src="{{ asset('storage/' . Auth::user()->image) }}"
                                            alt="Avatar" style="width:100%;">
                                        <h6 style="color: rgb(0, 255, 242)"><i
                                                class="fa-solid fa-user mr-2"></i>{{ Auth::user()->name }}</h6>

                                        @if ($reply)
                                            <p class="text-white">{{ $reply->message }}</p>
                                            <span class="time-right">11:00</span>
                                        @endif
                                    </div>

                                    <div class="container1 darker">
                                        <img src="https://i.pinimg.com/736x/74/f7/5f/74f75f9e9312aad67b6cb9b2d7cdf00b.jpg"
                                            alt="Avatar" class="left " style="width:100%;">
                                        <h6 class="" style="color: rgb(0, 255, 242)"><i
                                                class="fa-solid fa-users mr-2"></i>Admin Team</h6>

                                        @if ($reply)
                                            @if ($reply->admin_reply == null)
                                                <p class="text-warning"><i class="fa-solid fa-clock mr-2 text-warning"></i>
                                                    Please wait patiently ... our team
                                                    will leave a reply within a few minutes ...</p>
                                            @else
                                                <p class="text-success"><i
                                                        class="fa-solid fa-circle-check mr-2 text-success"></i> Please wait
                                                    patiently ... our
                                                    team will leave a reply within a few minutes ...</p>
                                            @endif
                                        @endif
                                        <span class="time-left">11:01</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
