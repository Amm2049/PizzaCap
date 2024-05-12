@extends('admin.master')

@section('title','Category Create Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('catagory#list') }}"><button style="background-color: black" class="btn text-white my-3 w-100">Back to list page</button></a>
                    </div>
                </div>
                <div class="col-lg-8 offset-2">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account-Info Edit</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#editAccount',Auth::user()->id) }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="row p-2 pt-4">
                                    <div class="col-6 text-center mt-2">
                                        @if (Auth::user()->image == null)
                                            <img class="img-thumbnail" style="height:50%;" src="{{ asset('image/default.jpeg') }}">
                                        @else
                                            <img class="img-thumbnail" style="height:50%;" src="{{ asset('storage/' . Auth::user()->image) }}">
                                        @endif

                                        <div class="form-group text-left mt-4">
                                            <input id="cc-pament" name="image"  type="file" class="form-control  @error('image') is-invalid @enderror">
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="form-group text-left">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" value="{{ old('role',Auth::user()->role) }}" type="text" class="form-control" disabled>
                                        </div>

                                        <div class="text-left">
                                            <button type="submit" style="background-color: black" class="btn text-white mt-4 w-100 py-2">Update</button>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" value="{{ old('name',Auth::user()->name) }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name ...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" value="{{ old('email',Auth::user()->email) }}" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email ...">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" value="{{ old('phone',Auth::user()->phone) }}" type="number" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone ...">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <input id="cc-pament" name="address" value="{{ old('address',Auth::user()->address) }}" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Enter address ...">
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="Male" @if(Auth::user()->gender == 'Male') selected @endif>Male</option>
                                                <option value="Female" @if(Auth::user()->gender == 'Female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
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
