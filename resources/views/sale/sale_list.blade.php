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
          <li class="breadcrumb-item active">House List Page</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->

      <div class="card">
        {{-- <div class="card-header">
          <a href="{{ url('create_house_form') }}">
            <button type="submit" class="btn btn-primary">Create Post of House</button>
          </a>
        </div> --}}
        <!-- /.card-header -->
       
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">    
            <thead>
            <tr>
              {{-- <th>Action</th> --}}
              <th>Sale ID</th>
              <th>Schedule ID</th>
              <th>User ID</th>
              <th>Product ID</th>
              <th>User ID of the Poster</th>
              <th>Price</th>
              <th>House Image</th>
              <th>Created At</th>
              <th>Updated At</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($sales as $sale)
              <tr>
                {{-- <td>
                  <a href="{{ url('update_house_form', $sale) }}">
                    <button type="submit" class="btn btn-info">Edit</button>
                  </a>
                </td> --}}
                <td>{{$sale->id}}</td>
                <td>{{$sale->schedule_id}}</td>
                <td>{{$sale->user_id}}</td>
                <td>{{$sale->product_id}}</td>
                <td>{{$sale->post_user_id}}</td>
                <td>{{$sale->product_price}}</td>
                <td><img src="/imagesHouses/{{$sale->product_image}}" alt="House Image" height="100" width="100"></td>
                <td>{{$sale->created_at}}</td>
                <td>{{$sale->updated_at}}</td>
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

