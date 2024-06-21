@include('admin.adminheader')
<div class="product-table">
    <div id="alert">
        @if (session()->has('alert'))
        <div class="alert alert-success">
            {{ session()->get('alert') }}
        </div>
        @endif
    </div>
    <center>
        <u><h2>Product Details</h2></u>
    </center>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Type</th>
            <th>Price</th>
            <th width="300px">Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach ($products as $x)
            <tr>
                <td>{{$x->id}}</td>
                <td><img width="100px" height="100px" src="{{asset('storage/'.$x->image)}}" alt="image"></td>
                <td>{{$x->name}}</td>
                <td>{{$x->category}}</td>
                <td>{{$x->price}}</td>
                <td>{{$x->description}}</td>
                <td>{{$x->status}}</td>
                <td>
                    <a href="{{route('admin.delete',$x->id)}}" class="btn btn-danger">Delete</a>
                    <a href="{{route('admin.show',$x->id)}}" class="btn btn-primary">Update</a>
                </td>
            </tr>
        @endforeach
    </table>
    <span class="page">
        {{ $products->onEachSide(3)->links() }}
    </span>
</div>
@include('admin.adminfooter')
