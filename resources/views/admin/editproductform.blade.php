@include('admin.adminheader')
<div class="product-table">
    <div id="alert">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>
    <center>
        <u>
            <h2>Product Details</h2>
        </u>
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
                <form action="" class="updateallform" method="POST" id="prodform{{ $x->id }}"
                    enctype="multipart/form-data">
                    @csrf
                    <td><input type="text" value="{{ $x->id }}" name="id[]" class="prodid"
                            style="border: transparent;width:50px;" readonly></td>
                    <td><img width="100px" height="100px" src="{{ asset('storage/' . $x->image) }}" alt="image"><br>
                        <input type="file" name="image[]" class="prodimage" id="prodimage{{ $x->id }}"
                            style="width: 100px;" hidden>
                    </td>
                    <td><input type="text" id="prodname{{ $x->id }}" class="prodname" name="name[]"
                            value="{{ $x->name }}" disabled></td>
                    <td><select name="category[]" class="prodcategory" id="prodcategory{{ $x->id }}" disabled>
                            <option value="mobile" {{ $x->category == 'mobile' ? 'selected' : '' }}>Mobile</option>
                            <option value="camera" {{ $x->category == 'camera' ? 'selected' : '' }}>Camera</option>
                            <option value="laptop" {{ $x->category == 'laptop' ? 'selected' : '' }}>Laptop</option>
                        </select></td>
                    <td><input type="text" id="prodprice{{ $x->id }}" class="prodprice" name="price[]"
                            value="{{ $x->price }}" disabled></td>
                    <td><input type="text" id="proddescription{{ $x->id }}" class="proddescription"
                            name="description[]" value="{{ $x->description }}" disabled></td>
                    <td>
                        <div class="prodstatus32">
                            Available: <input type="radio" name="status[{{ $x->id }}]" value="available"
                                class="prodstatus" id="prodstatus1{{ $x->id }}"
                                {{ $x->status == 'available' ? 'checked' : '' }} disabled>
                            Unavailable: <input type="radio" name="status[{{ $x->id }}]" value="unavailable"
                                class="prodstatus" id="prodstatus2{{ $x->id }}"
                                {{ $x->status == 'unavailable' ? 'checked' : '' }} disabled></div>
                    </td>
                    <td>
                        <a href="{{ route('admin.delete', $x->id) }}"><i class="fa-solid fa-trash"
                                style="color: #e60a41;"></i></a>
                        <button type="button" class="editbtn" id="editbtn{{ $x->id }}"
                            style="border: transparent;background-color:transparent;"><i class="fa-solid fa-pen"
                                style="color: #3c75d7;"></i></button>
                        <button type="submit" id="updbtn{{ $x->id }}" class="updbtn"
                            style="border: transparent;background-color:transparent;" hidden><i
                                class="fa-solid fa-pen-to-square" style="color: #B197FC;"></i></submit>
                    </td>
            </tr>
        @endforeach
        <button type="button" id="update-all" class="btn btn-primary" hidden>Update All</button>
        <button type="button" id="multipleupdate" style="float:right;margin:10px;" class="btn btn-dark">Update
            Multilple</button>
        </form>
    </table>
    <span class="page">
        {{ $products->onEachSide(3)->links() }}
    </span>
</div>
@include('admin.adminfooter')
<script>
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
    const editbtn = document.getElementsByClassName('editbtn');
    const updbtn = document.getElementsByClassName('updbtn');
    const name = document.getElementsByClassName('prodname');
    const price = document.getElementsByClassName('prodprice');
    const category = document.getElementsByClassName('prodcategory');
    const id = document.getElementsByClassName('prodid');
    const status = document.getElementsByClassName('prodstatus');
    const description = document.getElementsByClassName('proddescription');
    const images = document.getElementsByClassName('prodimage');
    for (let i = 0; i < editbtn.length; i++) {
        editbtn[i].addEventListener('click', function() {
            this.style.visibility = 'hidden';
            name[i].removeAttribute("disabled");
            price[i].removeAttribute("disabled");
            description[i].removeAttribute("disabled");
            category[i].removeAttribute("disabled");
            for (let k = i; k <= i; k++) {
                status[i + k].removeAttribute("disabled");
                status[i + k + 1].removeAttribute("disabled");
            }
            images[i].removeAttribute("hidden");
            updbtn[i].removeAttribute("hidden");
        })
    }
    let multipleupdate = document.getElementById('multipleupdate');
    let updateAll = document.getElementById('update-all');
    let updateallform = document.getElementsByClassName('updateallform');
    multipleupdate.addEventListener('click', function() {
        updateAll.removeAttribute('hidden');
        updateAll.addEventListener('click', function() {
            let prodsts = [];
            let prodname = [];
            let prodid = [];
            let prodcategory = [];
            let prodprice = [];
            let proddescription = [];
            let prodimage = [];
            for (i = 0; i < status.length; i++) {
                if (status[i].checked) {
                    prodsts.push(status[i].value);
                }
            }
            for (i = 0; i < name.length; i++) {
                prodname.push(name[i].value);
                prodid.push(id[i].value);
                prodcategory.push(category[i].value);
                prodprice.push(price[i].value);
                prodimage.push(images[i].value);
                proddescription.push(description[i].value);
            }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/form/update",
                    data: {
                        'id': prodid,
                        'name': prodname,
                        'price': prodprice,
                        'category': prodcategory,
                        'status': prodsts,
                        'images': prodimage,
                        'description': proddescription
                    },
                    method: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            alert(data.message);
                        } else {
                            alert(data.message);
                        }
                    }
                })

        })

        for (i = 0; i < editbtn.length; i++) {
            editbtn[i].style.visibility = 'hidden';
            name[i].removeAttribute("disabled");
            price[i].removeAttribute("disabled");
            description[i].removeAttribute("disabled");
            category[i].removeAttribute("disabled");
            // status1[i].removeAttribute("disabled");
            for (let k = i; k <= i; k++) {
                status[i + k].removeAttribute("disabled");
                status[i + k + 1].removeAttribute("disabled");
            }
            status[i + 1].removeAttribute("disabled");
            images[i].removeAttribute("hidden");
        }
    })
</script>
