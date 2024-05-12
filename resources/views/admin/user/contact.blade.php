@extends('admin.master')

@section('title', 'Users List Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    @if (count($contacts) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr class="tr-shadow">
                                            <input type="hidden" id="userId" value="{{ $contact->id }}">
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->created_at }}</td>
                                            <td>
                                                <a href="{{ route('user#viewReport',$contact->id) }}">
                                                    <button class="item mx-2" style="font-size: 20px" data-toggle="tooltip"
                                                        data-placement="top" title="View">
                                                        <i class="fa-solid fa-eye text-info"></i>
                                                    </button>
                                                </a>

                                                <button class="item mx-2 deleteBtn" style="font-size: 20px"
                                                    data-toggle="tooltip" data-placement="top" >
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
                            {{ $contacts->links() }}
                        </div>
                    @else
                        <h3 class="text-muted text-center p-5">There is no data here.</h3>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection

{{-- @section('scriptSection')

    <script>
        $(document).ready(function() {
            $('.deleteBtn').click(function() {
                $parentNode = $(this).parents('tr');
                $parentNode.remove();

                $name = $parentNode.find('#userId').val();

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8001/deleteContact',
                    data: {
                        'userId': $name,
                    },
                    dataType: 'json'
                })
            })
        })
    </script>

@endsection --}}
