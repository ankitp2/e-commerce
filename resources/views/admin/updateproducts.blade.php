@include('admin.adminheader')
<center>
    <div class="product-add">
        <h2><u>Update Product Details</u></h2>
        <form action="{{ route('admin.update',$data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" class="product-add-input" value="{{ $data->name }}">
            <p>Choose Product Image:</p>
            <input type="file" name="image"><br>
            <input type="number" name="price" class="product-add-input" value="{{ $data->price }}">
            <p>Choose Product Category:</p>
            <select name="category" class="product-add-input">
                <option value="mobile" {{ $data->category == 'mobile' ? 'selected' : '' }}>Mobile</option>
                <option value="camera" {{ $data->category == 'camera' ? 'selected' : '' }}>Camera</option>
                <option value="laptop" {{ $data->category == 'laptop' ? 'selected' : '' }}>Laptop</option>
            </select><br>
            <input type="text" name="description" class="product-add-input" value="{{ $data->description }}"><br>
            Availability:<br>
            Available: <input type="radio" name="status" value="available"
                {{ $data->status == 'available' ? 'checked' : '' }}>
            Unavailable: <input type="radio" name="status" value="unavailable"
                {{ $data->status == 'unavailable' ? 'checked' : '' }}><br>
            <input type="submit" class="btn btn-primary" value="Add Product" style="width: 350px;">
        </form>
    </div>
</center>
@include('admin.adminfooter')
