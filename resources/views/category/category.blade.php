@extends('layout.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Category</h1>
  <!-- <a href="/Add_Category" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm icon-fas" title=""><i class="fas fa-plus  fa-sm text-white-50"></i> New Category</a> -->
  <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#addCategory" ><i class="fas fa-plus  fa-sm fa-fw mr-2 text-gray-400"></i>New Category</a>
</div>
@if(Session::has('status'))
<div class="alert alert-info text-center">
    {{ Session::get('status') }}
</div>
@endif

<!-- Logout Modal-->
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="/add_new_cate" method="post" name="Cate">
      {{ csrf_field() }}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="form-group">
            <input type="txet" name="category" class="form-control form-control-user" id="exampleInputEmail" placeholder="Category Name">
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary submit">Add</button>
        </div>
      </form>
      </div>
    </div>
  </div>

<table class="table table-bordered table-sm table-hover" id="dataTable" width="100%">
  <thead>
    <tr>
      <th>Name</th>
      <th>No. of Sub Category</th>
      <th>Created date</th>
      <th>Status</th>
      <th>Action</th>
  <tfoot>
    <tr>
      <th>Name</th>
      <th>No. of Sub Category</th>
      <th>Created date</th>
      <th>Status</th>
      <th>Action</th>
  <tbody>

  @foreach($category as $cate)
    <tr>
      <td>{{ $cate->name }}</td>
      <td>{{ $cate->count }}</td>
      <td>{{ date('d-m-Y',strtotime($cate->created_at)) }}</td>
      <td class="{{ $cate->status=='1'?'text-success':'text-danger' }} font-weight-bolder">{{ $cate->status=='1'?'Active':'Inactive' }}</td>
      <td>
          <a href="/Edit_Category/{{ base64_encode($cate->category_id) }}" class="btn btn-sm btn-info icon-fas" title="Edit"><i class="fas fa-edit "></i></a>
          <!-- <button class="btn btn-sm btn-danger icon-fas" title="Delete"><i class="fas fa-trash "></i></button> -->
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

<script>
$("form[name='Cate']").validate({
    rules: {
      category: {
        required: true,
        minlength: 5
      }
    },
    messages: {
      category: {
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