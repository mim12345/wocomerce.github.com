<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>



  <div class="container ">

    <div class="card   mb-3 mt-5" style="max-width: 100%;">
        <div class="card-header bg-info text-center">Edit Category</div>
        <div class="card-body">

          @if (session('success'))

          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Good News!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <hr>
          @endif

          <form action="{{ url('/update-category-post') }}" method="POST">
            @csrf
            <input type="hidden" value="{{ $category->id }}" name=" category_id">

        <div class="form-group ">

          <label for="category_name">Name:</label>

          <input type="category_name" name="category_name" value="{{ $category->category_name  }}" class="form-control @error('category_name') is-invalid @enderror" id="category_name" placeholder="Enter name" >
          @error('category_name')
          <div class=" alert alert-danger">{{ $message }}</div>

          @enderror

        </div>

        <div class="form-group  text-center">
             <button type="submit" class="btn btn-primary">Update</button>
        </div>
  </form>

        </div>
      </div>

    </div>



</body>
</html>
