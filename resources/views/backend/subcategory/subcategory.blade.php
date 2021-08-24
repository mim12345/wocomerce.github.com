@extends('backend.master');

@section('content')


    <div class="content">
        <div class="container-fluid col-lg-8 ">

            <div class="card   mb-3  " style="max-width: 100%;">
                <div class="card-header bg-info text-center">Add Category</div>
                <div class="card-body">

                    @if (session('success'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Good News!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <hr>
                    @endif

                    <form action="{{ url('add-subcategory-post') }}" method="POST">
                        @csrf
                        <div class="form-group ">
                            <label for="subcategory_name">Name:</label>

                            <input type="subcategory_name" name="subcategory_name"
                                class="form-control @error('subcategory_name') is-invalid @enderror" id="subcategory_name"
                                placeholder="Enter subcategory name">
                            @error('category_name')
                                <div class=" alert alert-danger">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="form-group ">
                            <label for="category_id">Category Name:</label>

                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select One</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                                @endforeach
                            </select>



                        </div>

                        <div class="form-group  text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>


@endsection
