@include('admin.adminheader')
<div class="multipleproductcontainer">
    <h3>Add Products</h3>
    <div class="multipleproduct1">
        <form class="row g-3 needs-validation" action="{{ route('admin.addmultipleproduct.store') }}" method="POST"
            enctype="multipart/form-data" novalidate>
            @csrf
            <table class="table table-bordered" id="table">
                <tr>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Product Category</th>
                    <th>Product Description</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" name="name[]" id="name" required></td>
                    <td><input type="number" name="price[]" class="form-control" id="price" required>
                    </td>
                    <td><input class="form-control form-control-sm" name="image[]" style="width:200px;" id="image"
                            type="file"></td>
                    <td><select class="form-select" id="category" name="category[]" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="mobile">Mobile</option>
                            <option value="camera">Camera</option>
                            <option value="laptop">Laptop</option>
                        </select></td>
                    <td><input type="text" class="form-control" name="description[]" id="description" required>
                    </td>
                    <td><button id="addmultipleplus" type="button"><i class="fa-solid fa-plus"
                                style="color: #74C0FC;"></i></button>
                    </td>
                </tr>
            </table>
            <input type="submit" class="btn btn-primary" value="Submit form">
        </form>
    </div>
    <script>

    </script>
</div>
<script src="{{ asset('js/custom2.js') }}"></script>
@include('admin.adminfooter')

