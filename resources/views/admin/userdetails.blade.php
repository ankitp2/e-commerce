@include('admin.adminheader')
<div class="table-div">
    <center><u><h2 style="margin:20px; color:blueviolet">User Information</h2></u></center>
    <a href="{{route('export.user')}}" class="btn btn-success">Export CSV</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>Email</th>
            <th>Time of Joining</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $x)
        <tr>
            <td>{{$x->id}}</td>
            <td>{{$x->name}}</td>
            <td>{{$x->email}}</td>
            <td>{{$x->created_at}}</td>
            <td><a href="{{route('user.delete',$x->id)}}" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach

    </table>
    <span class="page">
        {{ $users->onEachSide(5)->links() }}
    </span>
</div>
@include('admin.adminfooter')
