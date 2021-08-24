@extends('backend.master');

@section('content')



    <div class="content">
        <div class="container-fluid">

            <div class="card   mb-3 " style="max-width: 100%;">
                <div class="card-header bg-info text-center"> <strong> Sub Category List (Total
                        {{ $scount }})</strong></div>
                <div class="card-body">
                    @if (session('delete'))

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
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

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Sub Category Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @forcach function us data show delete etc only --}}
                            {{-- @forelse ($subcategories as $key => $subcategory) --}}

                            {{-- @Forelse function  all data show and empty data "No Available Data" --}}

                            @forelse ($subcategories as $key => $subcategory)

                                <tr>
                                    <th scope="row">{{ $subcategories->firstitem() + $key }}</th>
                                    <td>{{ $subcategory->subcategory_name == '' ? 'N/A' : $subcategory->subcategory_name }}
                                    </td>
                                    {{-- Realtion with subcategory to category mode with show category data --}}

                                    <td>{{ $subcategory->get_category->category_name }}</td>
                                    <td>{{ $subcategory->created_at == '' ? 'N/A' : $subcategory->created_at->format('y-D-M') . ' ' . '(' . $subcategory->created_at->diffforhumans() . ')' }}
                                    </td>
                                    <td>
                                        <a href="{{ url('/edit-category') }}/{{ $subcategory->id }}"
                                            class=" btn btn-success">Edit</a>
                                        <a href="{{ url('/delete-subcategory') }}/{{ $subcategory->id }}"
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
                    {{ $subcategories->links() }}

                </div>
            </div>

        </div>
    </div>



@endsection
