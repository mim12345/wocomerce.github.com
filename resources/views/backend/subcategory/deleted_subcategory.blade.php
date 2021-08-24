

@extends('layouts.app');

@section('content')



  <div class="container ">

    <div class="card   mb-3 " style="max-width: 100%;">
        <div class="card-header bg-info text-center"> Sub Category Trashed (Total {{ $scount}})</div>
        <div class="card-body">
            @if (session('Restore'))

          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Good News!</strong> {{ session('Restore') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <hr>
          @endif

          @if (session('Delete'))

          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Opps!</strong> {{ session('Delete') }}
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

                 @forelse ($subcategories as $key=>$subcat )

                  <tr>
                    <th scope="row">{{ $subcategories->firstitem() + $key }}</th>
                    <td>{{ $subcat->subcategory_name == '' ? 'N/A'  : $subcat->subcategory_name }}</td>
                    <td>{{ $subcat->category_id == '' ? 'N/A'  : $subcat->category_id }}</td>
                    <td>{{$subcat->created_at == '' ? 'N/A'  : $subcat->created_at->format('y-D-M') . ' ' . '(' . $subcat->created_at->diffforhumans() . ')' }}</td>
                    <td>
                        <a  href="{{ url('/Restore-subcategory') }}/{{ $subcat->id }}" class=" btn btn-success" >Restore</a>
                        <a  href="{{ url('/Permanent-Deleted-subcategory') }}/{{ $subcat->id }}" class=" btn btn-danger">P Delete</a>
                    </td>
                    @empty
                        <tr>
                            <td colspan="10" class=" text-primary text-center">
                                <strong>No Data Available</strong>
                            </td>
                        </tr>

                  </tr>

                  @endforelse

                </tbody>
              </table>
            {{ $subcategories->links() }}

        </div>
      </div>

    </div>



@endsection
