@extends('layout.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
  <a href="/Category" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-leftarrow fa-sm text-white-50"></i>Back</a>
</div>

<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
@foreach($specification as $spec)
<form class="user" action="/save_edited_spec/{{ base64_encode($spec->specification_id) }}" method="post" name="EditSpec">
  {{ csrf_field() }}
  <div class="form-group">
    <select name="category" class="form-control" id="exampleInputEmail1">
      @foreach($category as $cate)
        @if($cate->category_id == $spec->category_id)
          <option value="{{ $cate->category_id }}" selected>{{ $cate->name }}</option>
        @else
        <option value="{{ $cate->category_id }}">{{ $cate->name }}</option>
        @endif
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <input type="text" name="name" value="{{ $spec->name }}" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Category Name">
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
        <div class="modal-body">
          <p>Are you sure? Do you want to delete this..?</p>
        </div>
        <div class="modal-footer">
          <a href="/Delete_spec/{{ base64_encode($spec->specification_id) }}" class="btn btn-danger">Delete</a>
        </div>
      </form>
      </div>
    </div>
  </div>

<script>
$("form[name='EditSpec']").validate({
    rules: {
      name: {
        required: true,
        minlength: 3
      }
    },
    messages: {
      name: {
        required: "Please enter category name",
        minlength: "Your category name must be at least 3 characters long"
      },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

</script>

@endsection