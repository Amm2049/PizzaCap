@extends('admin.master')

@section('title','Admin Catagory List Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('catagory#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show w-50" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa-solid fa-square-xmark"></i>       {{ session('deleteSuccess') }}
                            </button>
                        </div>
                    @endif

                    <div class="col-3 offset-9">
                        <form action="{{ route('catagory#list') }}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" value="{{ request('key') }}">
                                <button type="submit" class="btn btn-success text-white" placeholder="Search ..."><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>

                    @if (count($catagories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>name</th>
                                        <th>date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($catagories as $catagory)
                                        <tr class="tr-shadow">
                                            <td>{{ $catagory->id }}</td>
                                            <td class="col-4">{{ $catagory->name }}</td>
                                            <td>{{ $catagory->created_at }}</td>
                                            <td>
                                                <div class="table-data-feature">

                                                    <a href="{{ route('catagory#updatePage',$catagory->id) }}">
                                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('catagory#delete',$catagory->id) }}">
                                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $catagories->appends(request()->query())->links() }}
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
