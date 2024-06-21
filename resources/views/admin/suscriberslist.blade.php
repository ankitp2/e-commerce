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
        <u><h2>Suscribers</h2></u>
    </center>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Time of Suscription</th>
            <th>Action</th>
        </tr>
        @foreach ($data as $x)
            <tr>
                <td>{{$x->id}}</td>
                <td>{{$x->email}}</td>
                <td>{{$x->created_at}}</td>
                <td>
                    <a href="{{route('delete.suscriber',$x->id)}}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('export.suscriber') }}" class="btn btn-success">Export CSV</a>
    <button class="btn btn-success" id="importbtn" type="button">Import CSV</button>
        <div id="import_div" hidden>
            <form action="{{ route('import.suscriber') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="messages">
                  @if (session('success'))
                    <div class="alert alert-success">
                      {{ session('success') }}
                    </div>
                  @endif
                </div>
                <div class="fields">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="import_csv" name="import_csv" accept=".csv">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Import CSV</button>
            </form>
        </div>
</div>
@include('admin.adminfooter')
<script>
    const import_div=document.getElementById('import_div');
    const importbtn=document.getElementById('importbtn');
    importbtn.addEventListener('click',function(){
        importbtn.style.visibility = 'hidden';
        import_div.removeAttribute("hidden");
    })
</script>
