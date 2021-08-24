@extends('backend.master')

@section('content')
<div class="container">



	<div class=" col-10 card-box offset-1">
         <h4 class="header-title text-info "><strong>Edit Product</strong></h4>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show " role="alert">
            <strong>Wow!!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
           <hr>

        @endif


        <form class="form-horizontal" action="{{ url('/update-product-post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row ">
                <label for="product_name" class="col-sm-3 col-form-label ">Product Name:</label>
                <div class="col-sm-9">
                    <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control " id="product_name" placeholder="Product Name">
                </div>
            </div>

            <div class="form-group row ">
                <label for="category_id" class="col-sm-3 col-form-label ">Category Name:</label>
                <div class="col-sm-9">
                    <Select name="category_id" id="category_id" class="form-control text-dark">

                        @foreach ($categories as $cat)
                        <option @if ($cat->id == $product->category_id ) selected @endif value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </Select>
                </div>
            </div>

            <div class="form-group row ">
                <label for="subcategory_id" class="col-sm-3 col-form-label ">Sub Category Name:</label>
                <div class="col-sm-9">
                    <Select name="subcategory_id" id="subcategory_id" class="form-control text-dark">

                        @foreach ($subcategory as $scat)
                        <option @if ($scat->id == $product->subcategory_id ) selected @endif value="{{ $scat->id }}">{{ $scat->subcategory_name }}</option>
                        @endforeach
                    </Select>
                </div>
            </div>

            <div class="form-group row ">
                <label for="product_summary" class="col-sm-3 col-form-label ">Product Summary:</label>
                <div class="col-sm-9">
                  <textarea name="product_summary" id="product_summary" class="form-control ">{{ $product->product_summary }}</textarea>

                </div>
            </div>

            <div class="form-group row ">
                <label for="product_description" class="col-sm-3 col-form-label ">Product Description:</label>
                <div class="col-sm-9">
                    <textarea name="product_description" id="product_description" class="form-control">{{ $product->product_description }}</textarea>

                </div>
            </div>

            <div class="form-group row ">
                <label for="product_price" class="col-sm-3 col-form-label ">Product Price:</label>
                <div class="col-sm-9">
                    <input type="text" name="product_price" value="{{ $product->product_price }}" class="form-control  " id="product_price" placeholder="Product Price">

                </div>
            </div>

            <div class="form-group row ">
                <label for="product_quantity" class="col-sm-3 col-form-label ">Product Quantity:</label>
                <div class="col-sm-9">
                    <input type="text" name="product_quantity" value="{{ $product->product_quantity }}" class="form-control " id="product_quantity" placeholder="Product Quantity">

                </div>
            </div>

            <div class="form-group row ">
                <label for="product_thumbnail" class="col-sm-3 col-form-label ">Product Thumbnail:</label>
                <div class="col-sm-9">
                    <input type="file" name="product_thumbnail" class="form-control  " id="product_thumbnail" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" >

                </div>
            </div>

            <div class="form-group row ">
                <label for="" class="col-sm-3 col-form-label ">Product Preview:</label>
                <div class="col-sm-9">
                    <img id="blah" src="{{ url('/img/thumbnail').'/'.$product->product_thumbnail ?? '' }}" alt="Your Image" width="100" height="100" >
                </div>
            </div>

            <div class="form-group row ">
                <label for="product_gallery" class="col-sm-3 col-form-label ">Image Gallery:</label>
                <div class="col-sm-9">
                    <input type="file" multiple name="" class="form-control  " id="product_gallery" >

                </div>
            </div>

            <div class="form-group mb-0 justify-content-end row">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-info waves-effect waves-success">Save</button>
                </div>
            </div>
        </form>
    </div>



</div>
@endsection
