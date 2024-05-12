@extends('admin.master')

@section('title','Category Create Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#listPage') }}"><button style="background-color: black" class="btn text-white my-3">Back to previous page</button></a>
                    </div>
                </div>
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="card-title">
                                <h3 class="text-center title-2">New Pizza Create</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Pizza Name</label>
                                    <input id="cc-pament" name="pizzaName" value="{{ old('pizzaName') }}" type="text" class="form-control @error('pizzaName') is-invalid @enderror" placeholder="Enter pizza name ...">
                                    @error('pizzaName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Pizza Description</label>
                                    <textarea class="form-control @error('pizzaDescription') is-invalid @enderror" name="pizzaDescription" value="{{ old('pizzaDescription') }}" cols="30" rows="5"></textarea>
                                    @error('pizzaDescription')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Choose Catagory</label>
                                    <select class="form-control" name="pizzaCatagory">
                                        <option value="">Choose catagory ...</option>
                                        @foreach ($catagories as $catagory)
                                            <option value="{{ $catagory->id }}">{{$catagory->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCatagory')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input class="form-control @error('pizzaWaitingTime') is-invalid @enderror" name="pizzaWaitingTime" value="{{ old('pizzaWaitingTime') }}">
                                    @error('pizzaWaitingTime')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Pizza Image</label>
                                    <input id="cc-pament" name="pizzaImage" value="{{ old('pizzaImage') }}" type="file" class="form-control @error('pizzaImage') is-invalid @enderror">
                                    @error('pizzaImage')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Pizza Price</label>
                                    <input id="cc-pament" name="pizzaPrice" value="{{ old('pizzaPrice') }}" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" placeholder="Enter pizza price ...">
                                    @error('pizzaPrice')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" style="background-color: black" type="submit" class="btn btn-lg text-white btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-pizza-slice"></i>
                                    </button>
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
