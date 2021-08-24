@extends('Backend.master');

@section('header_css')

<link  href="{{ url('/') }}/assets/css/dataTables.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')



    <div class="content">
        <div class="container-fluid">

            <div class="card   mb-3 " style="max-width: 100%;">
                <div class="card-header bg-info text-center"> Category List</div>
                <div class="card-body">
                    @if (session('delete'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> {{ session('delete') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <hr>
                    @endif

                    @if (session('update'))

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Good News!</strong> {{ session('update') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <hr>
                    @endif

                    <table id="table_id" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @forcach function us data show delete etc only --}}
                            {{-- @forelse ($subcategories as $key => $subcategory) --}}

                            {{-- @Forelse function  all data show and empty data "No Available Data" --}}

                            @forelse ($category as $key=>$cat )

                                <tr>
                                    <th scope="row">{{ $category->firstitem() + $key }}</th>
                                    <td>{{ $cat->category_name == '' ? 'N/A' : $cat->category_name }}</td>
                                    <td>{{ $cat->created_at == '' ? 'N/A' : $cat->created_at->format('y-D-M') . ' ' . '(' . $cat->created_at->diffforhumans() . ')' }}
                                    </td>
                                    <td>
                                        <a href="{{ url('/edit-category') }}/{{ $cat->id }}"
                                            class=" btn btn-success">Edit</a>
                                        <a href="{{ url('/delete-category') }}/{{ $cat->id }}"
                                            class=" btn btn-danger">Delete</a>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="10" class=" text-primary text-center">
                                        <strong>No Data Available</strong>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                    {{ $category->links() }}

                </div>
            </div>

        </div>
    </div>


@endsection

@section('footer_js')



<script type="text/javascript" charset="utf8" src="{{ url('/') }}/assets/js/dataTables.min.js"></script>

<script>

$(document).ready( function () {
    $('#table_id').DataTable();
} );

</script>

@endsection
