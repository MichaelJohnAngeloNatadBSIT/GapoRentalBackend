@extends('adminlte')
@section('content')


    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
        <form method="POST" action="/update_schedule/{{ $schedule->id }}">
            @method('PUT')
            @csrf
            
            <div class="form-group">
                <label for="exampleInputEmail1">House Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="product_name" placeholder="Name" value="{{$schedule->product_name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Schedule Date</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="schedule_date" placeholder="Address" value="{{$schedule->schedule_date}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">House Price</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="product_price" placeholder="Price" value="{{$schedule->product_price}}">
            </div>
            {{-- <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
            </div> --}}
            <button class="btn btn-success" type="submit">Update</button>    
        </form>
  
    </div>
    <br/>
    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
    {{-- <form action="/delete_schedule/{{ $schedule->id }}" method="POST">
        @method('DELETE')
        @csrf  --}}
        {{-- <button class="btn btn-danger" type="submit">Delete</button> --}}
    {{-- </form> --}}

    <a href="/delete_schedule/{{ $schedule->id }}" class="btn btn-danger delete-confirm" role="button">Delete</a>
    </div>

@endsection