@include('admin.adminheader')
<div class="adminaboutcontainer">
    <h3>About Us</h3>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" value=""></textarea>
        <label for="floatingTextarea2" style="margin-left:20px;">Comments</label>
      </div>
      <form action="{{route('admin.about.store')}}" method="POST">
        @csrf
        <input type="text" name="about" id="abt" value="" hidden>
        <input type="submit" id="about-sbt" class="btn btn-dark" style="margin:20px;" value="Update About">
      </form>
</div>
@include('admin.adminfooter')
