@extends('admin.master')

@section('title','Category Update Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('catagory#list') }}"><button style="background-color: black" class="btn text-white my-3">Back to previous page</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Category Update</h3>
                            </div>
                            <hr>
                            <form action="{{ route('catagory#update') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input type="hidden" name="catagoryId" value="{{ old('catagoryName',$catagory->id) }}">
                                    <input id="cc-pament" name="catagoryName" value="{{ old('catagoryName',$catagory->name) }}" type="text" class="form-control @error('catagoryName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Catagory name ...">
                                    @error('catagoryName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" style="background-color:black"class="btn btn-lg text-white btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-right"></i>
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
