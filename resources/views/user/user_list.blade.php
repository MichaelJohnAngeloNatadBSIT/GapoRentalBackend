  @extends('adminlte')
  @section('content')
      <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User List Page</h1>
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
            <a href="{{ url('create_form') }}">
              <button type="submit" class="btn btn-primary">Create User</button>
            </a>
          </div>
          <!-- /.card-header -->
         
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">    
              <thead>
              <tr>
                <th>Action</th>
                <th>User ID</th>
                <th>User Image</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>

              </tr>
              </thead>
              <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>
                    <a href="{{ url('update_form', $user) }}">
                      <button type="submit" class="btn btn-info">Edit</button>
                    </a>
                  </td>
                  <td>{{$user->id}}</td>
                  <td><img src="/images/{{$user->image}}" alt="User Avatar" class="img-size-50 mr-3 img-circle"></td>
                  <td>{{$user->first_name}}</td>
                  <td>{{$user->last_name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->created_at}}</td>
                  <td>{{$user->updated_at}}</td>
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
  
  