@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form method="post" action="">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" placeholder="Enter email" name="email" value="{{ $user->email }}">
                </div>
                <select class="form-control" name="roles[]" multiple="multiple">
                    @foreach($roles as $role)
                        <option
                            {{$listRolesUser->contains($role->id) ? 'Selected' : ''}}
                            value="{{ $role->id }}">
                            {{$role->display_name}}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
