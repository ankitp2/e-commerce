@include('admin.adminheader')
<div class="adminenquiry-container">
    <div class="adminenquiry-main">
        <h4 style="font-family:'Times New Roman', Times, serif;font-size:30px;font-weight:600;text-decoration:underline;">Enquiry</h4>
        <div class="adminenquiry-main1">
            <form action="{{route('admin.enquiryresult')}}" method="POST">
                @csrf
                <input type="date" class="dt" name="from"><br>
                <input type="date" class="dt" name="to"><br>
                Placed:<input type="radio" name="status" value="placed">
                Confirmed:<input type="radio" name="status" value="confirmed">
                Shipped:<input type="radio" name="status" value="shipped">
                Out for Delivery:<input type="radio" name="status" value="out for delivery">
                Delivered:<input type="radio" name="status" value="delivered">
                Cancelled:<input type="radio" name="status" value="cancelled"><br>
                <input type="submit" value="See Result" class="btn btn-dark" style="margin: 10px;">
            </form>
        </div>
    </div>
</div>
@include('admin.adminfooter')
