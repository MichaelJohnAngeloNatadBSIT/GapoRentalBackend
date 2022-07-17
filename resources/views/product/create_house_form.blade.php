@extends('adminlte')
@section('content')


    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
        <form method="POST" action="/create_house">
            @csrf
            
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="address" placeholder="Address">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Price</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="price" placeholder="Price">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="description" placeholder="Description">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Status</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="status" placeholder="Status">
            </div>
            {{-- <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
            </div> --}}
            <button class="btn btn-success" type="submit">Create House</button>    
        </form>
  
    </div>
    {{-- <br/> --}}
    {{-- <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger"> --}}
    {{-- <form action="/delete_product/{{ $product->id }}" method="POST">
        @method('DELETE')
        @csrf  --}}
        {{-- <button class="btn btn-danger" type="submit">Delete</button> --}}
    {{-- </form> --}}

    {{-- <a href="/delete_product/{{ $product->id }}" class="btn btn-danger delete-confirm" role="button">Delete</a> --}}
    </div>

@endsection