@extends('layout.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
  <a href="/Category" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-leftarrow fa-sm text-white-50"></i>Back</a>
</div>

<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
@foreach($category as $cate)
<form class="user" action="/save_edited/{{ base64_encode($cate->category_id) }}" method="post" name="EditCate">
  {{ csrf_field() }}
  <div class="form-group">
    <input type="text" name="name" value="{{ $cate->name }}" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Category Name">
  </div>
  <div class="form-group row">
  <div class="col-6 custom-control custom-checkbox small">
  <label class="text-dark">Status</label>
  </div>
    <div class=" col custom-control custom-checkbox small">
      <input type="radio" name="status" class="custom-control-input" value="1" id="Active" {{$cate->status=='1'?'checked':''}}>
      <label class="custom-control-label" for="Active">Active</label>
    </div>
    <div class="col custom-control custom-checkbox small">
      <input type="radio" name="status" class="custom-control-input" value="0" id="In-Active" {{$cate->status=='0'?'checked':''}}>
      <label class="custom-control-label" for="In-Active">In-Active</label>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <button type="button" class="btn btn-danger btn-user shadow-sm" data-toggle="modal" data-target="#delete_cate" style="min-width:100px">Delete</button>
    </div>
    <div class="col text-right">
      <button type="submit" class="btn btn-primary btn-user" style="min-width:100px">Save</button>
    </div>
  </div>
</form>
@endforeach
</div>

<!-- Logout Modal-->
<div class="modal fade" id="delete_cate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/Delete_cate/{{ base64_encode($cate->category_id) }}" method="post">
        {{ csrf_field() }}
        <div class="modal-body">
          <p>Are you sure? Do you want to delete this..?</p>
          <div class="custom-control custom-checkbox small">
            <input type="checkbox" name="subcategory" value="subcategory" class="custom-control-input" id="subcate">
            <label class="custom-control-label" for="subcate">Delete Sub Category</label>
          </div>
          <div class="custom-control custom-checkbox small">
            <input type="checkbox" name="specification" value="specification" class="custom-control-input" id="spec">
            <label class="custom-control-label" for="spec">Delete Specification</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
      </div>
    </div>
  </div>

<script>
$("form[name='EditCate']").validate({
    rules: {
      name: {
        required: true,
        minlength: 5
      }
    },
    messages: {
      name: {
        required: "Please enter category name",
        minlength: "Your category name must be at least 5 characters long"
      },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

</script>

@endsection