@extends('admin.master')

@section('title', 'Admin List Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

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
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="tr-shadow">
                                        <input type="hidden" id="userId" value="{{ $user->id }}">
                                        <td class="col-2">
                                            @if ($user->image == null)
                                                <img style="height:100%;" src="{{ asset('image/admin.jpg') }}">
                                            @else
                                                <img style="height:100%;" src="{{ asset('storage/' . $user->image) }}">
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <select class="form-control changeRole">
                                                <option value="admin" @if ($user->role == 'admin') selected @endif>
                                                    Admin</option>
                                                <option value="user" @if ($user->role == 'user') selected @endif>
                                                    User</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('user#editPage',$user->id) }}" >
                                                <button class="item mx-2" data-toggle="tooltip"
                                                    data-placement="top" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square text-info"></i>
                                                </button>
                                            </a>
                                                <button class="item mx-2 deleteBtn" data-toggle="tooltip"
                                                    data-placement="top">
                                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                                </button>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $users->links() }}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection

@section('scriptSection')

    <script>
        $(document).ready(function() {
            $('.changeRole').change(function() {
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();

                $currentStatus = $parentNode.find('.changeRole').val();

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8001/user/changeRole',
                    data: {
                        'userId': $userId,
                        'role': $currentStatus
                    },
                    dataType: 'json'
                })
                location.reload();
            })

            $('.deleteBtn').click(function(){
                $parentNode = $(this).parents('tr');
                $parentNode.remove();

                $userId = $parentNode.find('#userId').val();

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8001/user/delete',
                    data: {
                        'userId': $userId,
                    },
                    dataType: 'json'
                })
            })
        })
    </script>

@endsection
