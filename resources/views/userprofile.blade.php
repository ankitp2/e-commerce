@include('frontend.header')
<div id="alert">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if (session()->has('danger'))
    <div class="alert alert-danger">
        {{ session()->get('danger') }}
    </div>
    @endif
</div>
<div class="user-container">
    <div class="profcontainer1">
        <img src="{{asset('storage/'.$user->profile_pic)}}" alt="">
        <div>
            <button id="profile_pic_btn"><i class="fa-regular fa-pen-to-square" style="color: #74C0FC;"></i></button>
            <form action="{{route('user.profilepic')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input style="margin:10px;" id="prof" type="file" name="file"  class="form-control form-control-sm" hidden>
                <input type="submit" class="btn btn-dark" value="Change Profile Pic" id="btn-drk" hidden>
            </form>
        </div>
    </div>
    <div class="profcontainer2">
        <h2>Profile Information</h2>
        <div class="profilecontainer2-1">
            <span>Name:</span>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="name" value="{{ $user->name }}" id="username" disabled="false">&nbsp;&nbsp;
            <button id="username-btn"><i class="fa-regular fa-pen-to-square" style="color: #74C0FC;"></i></button>
        </div>
        <div class="profilecontainer2-2">
            <span>EmailID:</span>
            <input type="text" name="name" value="{{ $user->email }}" id="useremail"
                disabled="false">&nbsp;&nbsp;
            <button id="useremail-btn"><i class="fa-regular fa-pen-to-square" style="color: #74C0FC;"></i></button>
        </div>
        <div class="profilecontainer2-3">
            <!-- Button trigger modal -->
            <span>Change Password:</span>
            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                data-bs-target="#exampleModalP">
                Change Password
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                                style="margin-left:280px;border:transparent;border-radius:50%;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('password.update',$user->id)}}" method="POST">
                                @csrf
                                <input type="password" class="pw-form" name="password" placeholder="Enter Old Password">
                                <input type="password" class="pw-form" name="npassword"
                                    placeholder="Enter New Password">
                                <input type="password" class="pw-form" name="cpassword" placeholder="Confirm Password">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            <input type="submit" value="Change Password" id="pw-btn">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profilecontainer2-4">
            <form action="{{route('user.update',$user->id)}}" method="POST">
                @csrf
                <input type="hidden" id="newusername" name="name" value=" ">
                <input type="hidden" id="newemail" name="email" value=" ">
                <input type="submit" id="userupdate" value="Save Changes" hidden>
            </form>
        </div>
    </div>
    <div class="profcontainer3">
        <h2>Saved Address:</h2>
        @foreach ($address as $x)
            <b style="color:slateblue;">✯</b>
            <input type="text" id="adds-input{{ $x->id }}" name="address"
                value="{{ $x->name }},{{ $x->mob }},{{ $x->hno }},{{ $x->area }},{{ $x->city }},{{ $x->state }},{{ $x->lmark }},{{ $x->pin }}"
                disabled="false">
            {{-- <button id="useraddress-btn{{ $x->id }}"
                class="useraddress-btn"><i class="fa-regular fa-pen-to-square" style="color: #74C0FC;"></i></button> --}}
                <button type="button" id="useraddress-btn{{ $x->id }}"
                    class="useraddress-btn" data-bs-toggle="modal" data-bs-target="#exampleModaln">
                    <i class="fa-regular fa-pen-to-square" style="color: #74C0FC;"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModaln" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="margin-right: 320px;">Add Address
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                                    style="border:transparent;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('address.update',$x->id) }}" method="POST">
                                    @csrf
                                    <div class="addr-form">
                                        <div class="addrform1">
                                            <input type="text" name="name" value="{{$x->name}}">
                                        </div>
                                        <div class="addrform5">
                                            <input type="number" name="mob" value="{{$x->mob}}">
                                        </div>
                                        <div class="addrform2">
                                            <input type="text" name="hno" value="{{$x->hno}}">
                                            <input type="text" name="area" value="{{$x->area}}">
                                        </div>
                                        <div class="addrform3">
                                            <input type="text" name="city" value="{{$x->city}}">
                                            <input type="number" name="pin" value="{{$x->pin}}">
                                        </div>
                                        <div class="addrform4">
                                            <input type="text" name="state" value="{{$x->state}}">
                                            <input type="text" name="lmark" value="{{$x->lmark}}">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Save">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            &nbsp;
            <a href="{{route('address.delete',$x->id)}}" id="useraddressdlt-btn"><i class="fa-solid fa-trash" style="color: #b12b2b;"></i></a>
            <br>
        @endforeach
        <button type="button" id="addAddress" data-bs-toggle="modal" data-bs-target="#exampleModalAdd">
            <i class="fa-solid fa-plus" style="color: #84b3f0;"></i>Add Address
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalAdd" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="margin-right: 320px;">Add Address
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            style="border:transparent;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('new.address') }}" method="POST">
                            @csrf
                            <div class="addr-form">
                                <div class="addrform1">
                                    <input type="text" name="name" placeholder="Name">
                                </div>
                                <div class="addrform5">
                                    <input type="number" name="mob" placeholder="Mobile No">
                                </div>
                                <div class="addrform2">
                                    <input type="text" name="hno" placeholder="House No.">
                                    <input type="text" name="area" placeholder="Area">
                                </div>
                                <div class="addrform3">
                                    <input type="text" name="city" placeholder="City">
                                    <input type="number" name="pin" placeholder="Pin Code">
                                </div>
                                <div class="addrform4">
                                    <input type="text" name="state" placeholder="State">
                                    <input type="text" name="lmark" placeholder="Landmark">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.footer')
