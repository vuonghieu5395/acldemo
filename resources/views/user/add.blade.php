@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form method="post" action="">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" name="confirm_password">
                </div>
                <select class="form-control" name="roles[]" multiple="multiple">
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{$role->display_name}}</option>
                        @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
