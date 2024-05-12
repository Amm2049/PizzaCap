@extends('user.master')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('user#homePage') }}"><button style="background-color: rgb(0, 0, 0)"
                                class="btn rounded text-white my-3">Back to previous page</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Category Create</h3>
                            </div>
                            <hr>
                            <form action="{{ route('user#password') }}" method="post" novalidate="novalidate"
                                class="p-3">
                                @csrf

                                @if (session('notMatch'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-square-xmark"></i> {{ session('notMatch') }}
                                    </div>
                                @endif
                                @if (session('match'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-square-xmark"></i> {{ session('match') }}
                                </div>
                                @endif

                                <div class="form-group mb-4">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password"
                                        class="form-control @if (session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter current password ...">
                                    @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password"
                                        class="form-control @error('newPassword') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter new password ...">
                                    @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="cc-payment" class="control-label mb-1">Confirm new password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password"
                                        class="form-control @error('confirmPassword') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false"
                                        placeholder="Confirm new password name ...">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" style="background-color: rgb(0, 0, 0)"
                                        class="btn btn-lg btn-info btn-block">
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
