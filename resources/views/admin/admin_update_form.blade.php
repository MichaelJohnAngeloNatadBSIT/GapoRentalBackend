@extends('adminlte')
@section('content')


    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
        <form method="POST" action="/update_admin/{{ Auth::guard('admin')->user()->id }}">
            @method('PUT')
            @csrf
            
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email" value="{{Auth::guard('admin')->user()->email}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="first_name" placeholder="First Name" value="{{Auth::guard('admin')->user()->first_name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="last_name" placeholder="Last Name" value="{{Auth::guard('admin')->user()->last_name}}">
            </div>

           
            {{-- <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
            </div> --}}
            <button class="btn btn-success" type="submit">Update</button>    
        </form>
        <br/>
        <br/>
        <form method="post" action="/update_admin_image/{{ Auth::guard('admin')->user()->id }}" enctype="multipart/form-data">
            @csrf
            <div class="image">
                <label><h4>Update Profile Image</h4></label>
                <input type="file" class="form-control" required name="image">
            </div>
            <br/>
            <div class="post_button">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </form>
  
    </div>
    <br/>
    {{-- <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
        <a href="/delete_user/{{ Auth::guard('admin')->user()->id }}" class="btn btn-danger delete-confirm" role="button">Delete</a>
    </div> --}}

@endsection