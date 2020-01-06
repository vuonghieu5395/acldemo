@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a class="btn btn-primary" href="{{ route('role.add') }}">Add</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Display Name</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listRole as $role)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('role.edit',[$role->id])}}">Edit</a>
                        <a class="btn btn-danger" href="#">Delete</a>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
