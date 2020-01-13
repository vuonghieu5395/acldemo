@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a class="btn btn-primary" href="{{ route('user.add') }}">Add</a>
            <a class="btn btn-primary" style="margin-left: 900px" href="">Edit</a>
            <a class="btn btn-del btn-danger ml-2" href="#">Delete</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listUser as $user)
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img style="width: 5%" src="{{ asset('storage\logos/'.$user->image) }}" alt="" title="">
                        </td>
                        <td>
                            <input type="checkbox" name="checkbox[]" id="checkbox" value="{{$user->id}}">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function () {
          $('.btn-del').click(function () {
              if (confirm("are you sure?")) {
                  var id = [];
                  $(':checkbox:checked').each(function (i) {
                      id[i] = $(this).val();console.log(id[i]);
                  });
                  if (id.length === 0 ) {
                      alert('check di pls');
                  }
              }else {

                  {{--$.ajax({--}}
                  {{--    url:'{{route('user.delete',['id'])}}',--}}
                  {{--    method: 'POST',--}}
                  {{--    data:{id:id},--}}
                  {{--    success:function () {--}}
                  {{--          for(var i=0; i<id.length;i++){--}}

                  {{--          }--}}
                  {{--    }--}}
                  {{--})--}}
              }
          })
      })
    </script>

@endsection
