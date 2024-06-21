@include('admin.adminheader')
<center><div class="product-add">
    <h2><u>Add Products</u></h2>
    <div id="alert">
        @if (session()->has('alert'))
        <div class="alert alert-success">
            {{ session()->get('alert') }}
        </div>
        @endif
    </div>
    <form action="{{route('admin.save')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" class="product-add-input" placeholder="Enter Product Name">
        <p>Choose Product Image:</p>
        <input type="file" name="image"><br>
        <input type="number" name="price" class="product-add-input" placeholder="Enter Product Price">
        <p>Choose Product Category:</p>
        <select name="category" class="product-add-input" >
            <option value="mobile">Mobile</option>
            <option value="camera">Camera</option>
            <option value="laptop">Laptop</option>
          </select><br>
        <input type="text" name="description" class="product-add-input" placeholder="Enter Product Description"><br>
        Availability:<br>
        Available: <input type="radio" name="status" value="available">
        Unavailable: <input type="radio" name="status" value="unavailable"><br>
        <input type="submit" class="btn btn-primary" value="Add Product" style="width: 350px;">
    </form>
    <a href="{{route('admin.addmultipleproduct')}}">Add Multiple products</a>
</div></center>
@include('admin.adminfooter')
