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
                <div class="col-lg-6 offset-3 mt-5">
                    <form action="{{ route('admin#changeRole',$account->id) }}" method="post">
                        @csrf
                        <div class="bg-dark p-5 text-center">
                            <h3 class="mb-4 text-white">Are you sure you want to change this account's role?</h3>
                            {{-- <select name="role" class="form-control col-6 offset-3">
                                <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                            </select> --}}
                            <label for="cc-payment" class="control-label mb-1 text-white">Choose Role</label>
                            <select name="role" class="form-control">
                                <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                            </select>
                            <button type="submit" class="btn btn-success mt-4">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
