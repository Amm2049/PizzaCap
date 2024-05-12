@extends('admin.master')

@section('title', 'Admin List Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    @if (session('delete'))
                        <div class="alert alert-danger alert-dismissible fade show w-50" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa-solid fa-square-xmark"></i> {{ session('delete') }}
                            </button>
                        </div>
                    @endif

                    <div class="col-3 offset-9">
                        <form action="{{ route('admin#listPage') }}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="Search ..." value="{{ request('key') }}">
                                <button type="submit" class="btn btn-success text-white" ><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>


                    @if (count($admins)!=0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr class="tr-shadow">
                                            <td class="col-2">
                                                @if ($admin->image == null)
                                                    <img style="height:100%;" src="{{ asset('image/admin.jpg') }}">
                                                @else
                                                    <img style="height:100%;" src="{{ asset('storage/' . $admin->image) }}">
                                                @endif
                                            </td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->gender }}</td>
                                            <td>{{ $admin->phone }}</td>
                                            <td>{{ $admin->address }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id == $admin->id)
                                                    @else
                                                        <a href="{{ route('admin#changeRolePage', $admin->id) }}">
                                                            <button class="item mx-2" data-toggle="tooltip"
                                                                data-placement="top" title="Change Role">
                                                                <i class="fa-solid fa-pen-to-square text-info"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin#delete', $admin->id) }}">
                                                            <button class="item mx-2" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash-can text-danger"></i>
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $admins->appends(request()->query())->links() }}
                        </div>
                    @else
                        <h3 class="text-muted text-center p-5">There is no data here.</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
