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
                    <label for="display_name">Display Name</label>
                    <input type="text" class="form-control" placeholder="Enter display name" name="display_name">
                </div>
                @foreach($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $permission->id }}">
                    <label class="form-check-label">{{ $permission->display_name }}</label>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
