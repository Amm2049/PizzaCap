@extends('admin.master')

@section('title','Category Create Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#listPage') }}"><button class="btn text-white my-3" style="background-color: black">Back to List Page</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza Info</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}" method="post" novalidate="novalidate" enctype="multipart/form-data" class="mt-5">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                    <div class="col-6">
                                        <img src="{{asset('storage/'.$pizza->image)}}" style="width:100%;">
                                        <div class="form-group mt-3">
                                            <label for="cc-payment" class="control-label mb-1">Pizza Image</label>
                                            <input id="cc-pament" name="pizzaImage" alt="{{ old('pizzaImage') }}" type="file" class="form-control @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg text-white btn-block" style="background-color: black">
                                                <span id="payment-button-amount">Create</span>
                                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                                <i class="fa-solid fa-pizza-slice"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Pizza Name</label>
                                            <input id="cc-pament" name="pizzaName" value="{{ old('pizzaName',$pizza->name) }}" type="text" class="form-control @error('pizzaName') is-invalid @enderror" placeholder="Enter pizza name ...">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Pizza Description</label>
                                            <textarea class="form-control @error('pizzaDescription') is-invalid @enderror" name="pizzaDescription" cols="30" rows="5">{{ old('pizzaDescription',$pizza->description) }}</textarea>
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
                                                    <option value="{{ $catagory->id }}" @if($pizza->catagory_id == $catagory->id) selected @endif>{{$catagory->name}}</option>
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
                                            <input class="form-control @error('pizzaWaitingTime') is-invalid @enderror" name="pizzaWaitingTime" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Pizza Price</label>
                                            <input id="cc-pament" name="pizzaPrice" value="{{ old('pizzaPrice',$pizza->price) }}" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" placeholder="Enter pizza price ...">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Counts</label>
                                            <input id="cc-pament" name="" value="{{ $pizza->view_count }}" type="number" class="form-control" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament" name="pizzaPrice" value="{{ $pizza->created_at->format('j-F-Y') }}" type="string" class="form-control" disabled>
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
