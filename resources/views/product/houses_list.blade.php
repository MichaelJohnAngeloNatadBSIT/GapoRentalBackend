@extends('adminlte')
@section('content')
    <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">House List Page</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">First Page</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->

      <div class="card">
        <div class="card-header">
          <a href="{{ url('create_house_form') }}">
            <button type="submit" class="btn btn-primary">Create Post of House</button>
          </a>
        </div>
        <!-- /.card-header -->
       
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">    
            <thead>
            <tr>
              <th>Action</th>
              <th>House ID</th>
              <th>User ID</th>
              <th>House Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Address</th>
              <th>Description</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Updated At</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
              <tr>
                <td>
                  <a href="{{ url('update_house_form', $product) }}">
                    <button type="submit" class="btn btn-info">Edit</button>
                  </a>
                </td>
                <td>{{$product->id}}</td>
                <td>{{$product->user_id}}</td>
                <td><img src="/imagesHouses/{{$product->imageUrl}}" alt="House Image" height="100" width="100"></td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->address}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->status}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->updated_at}}</td>
              </tr> 
            </form> 
            @endforeach
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
<!-- /.content -->
@endsection

