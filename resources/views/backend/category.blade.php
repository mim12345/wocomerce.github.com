@extends('backend.master')

@section('content')
<div class="container">



	<div class=" col-10 card-box offset-1">
        <h4 class="header-title text-info "><strong>Add Product</strong></h4>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show " role="alert">
            <strong>Good News!!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
           <hr>

        @endif


        <form class="form-horizontal" action="{{ url('/add-category-post') }}" method="POST" >
            @csrf
            <div class="form-group row ">
                <label for="category_name" class="col-sm-3 col-form-label ">Product Name:</label>
                <div class="col-sm-9">
                    <input type="text" name="category_name" class="form-control " id="category_name" placeholder="Category Name">
                </div>
            </div>



            <div class="form-group mb-0 justify-content-end row">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                </div>
            </div>
        </form>
    </div>



</div>
@endsection
