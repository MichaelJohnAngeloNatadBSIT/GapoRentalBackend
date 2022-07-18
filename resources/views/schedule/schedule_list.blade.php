@extends('adminlte')
@section('content')
    <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Schedules List Page</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Schedule List Page</li>
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
              <th>Schedule ID</th>
              <th>User ID</th>
              <th>schedule ID</th>
              <th>House Name</th>
              <th>House Image</th>
              <th>House Price</th>
              <th>Schedule Date</th>
              <th>User ID of the Original Poster</th>
              <th>Created At</th>
              <th>Updated At</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($schedules as $schedule)
              <tr>
                {{-- <td>
                  <a href="{{ url('update_schedule_form', $schedule) }}">
                    <button type="submit" class="btn btn-info">Edit</button>
                  </a>
                </td> --}}
                <td>{{$schedule->id}}</td>
                <td>{{$schedule->user_id}}</td>
                <td>{{$schedule->product_id}}</td>
                <td>{{$schedule->product_name}}</td>
                <td><img src="/imagesHouses/{{$schedule->product_image}}" alt="House Image" height="100" width="100"></td>
                <td>{{$schedule->product_price}}</td>
                <td>{{$schedule->schedule_date}}</td>
                <td>{{$schedule->post_user_id}}</td>
                <td>{{$schedule->created_at}}</td>
                <td>{{$schedule->updated_at}}</td>
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

