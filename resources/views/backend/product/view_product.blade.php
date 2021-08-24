@extends('backend.master');

@section('content')



    <div class="content ">
        <div class="container-fluid ">

            <div class="card   mb-3  " style="max-width: 100%;">
                <div class="card-header bg-info text-center"> <strong> Product List (Total
                        {{-- {{ $scount }})</strong> --}}
                    </div>
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

                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">SubCategory Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Thumbnail Image</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @forcach function us data show delete etc only --}}
                            {{-- @forelse ($subcategories as $key => $subcategory) --}}

                            {{-- @Forelse function  all data show and empty data "No Available Data" --}}

                            @forelse ($products as $key => $item)

                                <tr>
                                    <th scope="row">{{ $products->firstitem() + $key }}</th>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->get_category->category_name }}</td>

                                    {{-- Realtion with subcategory to category mode with show category data --}}

                                    <td>{{ $item->get_subcategory->subcategory_name }}</td>
                                    <td>{{ $item->product_price }}</td>
                                    <td>{{ $item->product_quantity }}</td>
                                    <td><img src="{{ url('/img/thumbnail').'/'.$item->product_thumbnail }}" alt="" width="50"></td>
                                    <td>{{ $item->created_at == '' ? 'N/A' : $item->created_at->format('y-D-M') . ' ' . '(' . $item->created_at->diffforhumans() . ')' }}</td>

                                    <td class=" offset-1">
                                        <a target="_blank" href="{{ url('/item') }}/{{ $item->slug }}"
                                            class=" btn btn-success">View</a>
                                        <a href="{{ url('/edit-product') }}/{{ $item->id }}"
                                            class=" btn btn-success">Edit</a>
                                        <a href="{{ url('/delete-product') }}/{{ $item->id }}"
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
                    {{ $products->links() }}

                </div>
            </div>

        </div>
    </div>



@endsection
