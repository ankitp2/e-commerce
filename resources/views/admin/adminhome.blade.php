@include('admin.adminheader')
<div class="adminhome-container">
    <h3>Home Page</h3>

    <div class="admin-home">

        <div class="admin-home1">
            <div class="card" style="width: 18rem;height: 150px;">
                <div class="card-body">
                    <h5 class="card-title">ITEM ORDERED THIS MONTH</h5>
                    <span class="card-text" style="margin-right: 50px;">{{ $total_order }}</span>
                    <a href="{{ route('admin.order.cm') }}" style="border-radius: 50%;border:transparent;" class="btn btn-outline-dark"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="admin-home2">
            <div class="card" style="width: 18rem;height: 150px;">
                <div class="card-body">
                    <h5 class="card-title" style="color: rgb(248, 8, 108);">ITEM PLACED</h5>
                    <span class="card-text">{{ $placed }}</span>
                    <a href="{{ route('admin.order.placed') }}" style="border-radius: 50%;border:transparent;" class="btn btn-outline-dark"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="admin-home3">
            <div class="card" style="width: 18rem;height: 150px;">
                <div class="card-body">
                    <h5 class="card-title">ITEM CONFIRMED</h5>
                    <span class="card-text">{{ $confirmed }}</span>
                    <a href="{{ route('admin.order.confirmed') }}" style="border-radius: 50%;border:transparent;" class="btn btn-outline-dark"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="admin-home4">
            <div class="card" style="width: 18rem;height: 150px;">
                <div class="card-body">
                    <h5 class="card-title" style="color: rgb(143, 13, 250);">ITEM SHIPPED</h5>
                    <span class="card-text">{{ $shipped }}</span>
                    <a href="{{ route('admin.order.shipped') }}" style="border-radius: 50%;border:transparent;" class="btn btn-outline-dark"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="admin-home5">
            <div class="card" style="width: 18rem;height: 150px;">
                <div class="card-body">
                    <h5 class="card-title" style="color: rgb(129, 150, 9);">ITEM OUT FOR DELIVERY</h5>
                    <span class="card-text">{{ $out_for_delivery }}</span>
                    <a href="{{ route('admin.order.ofd') }}" style="border-radius: 50%;border:transparent;" class="btn btn-outline-dark"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="admin-home6">
            <div class="card" style="width: 18rem;height: 150px;">
                <div class="card-body">
                    <h5 class="card-title" style="color: rgb(0, 201, 252);">ITEM DELIVERED TODAY</h5>
                    <span class="card-text">{{ $delivered_today }}</span>
                    <a href="{{ route('admin.order.dt') }}" style="border-radius: 50%;border:transparent;" class="btn btn-outline-dark"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="admin-home7">
            <div class="card" style="width: 18rem;height: 150px;">
                <div class="card-body">
                    <h5 class="card-title" style="color: red;">ITEM CANCELLED TODAY</h5>
                    <span class="card-text">{{ $cancelled_today }}</span>
                    <a href="{{ route('admin.order.ct') }}" style="border-radius: 50%;border:transparent;" class="btn btn-outline-dark"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.adminfooter')
