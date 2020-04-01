@extends('layout.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Specification</h1>
  <!-- <a href="/Add_Category" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm icon-fas" title=""><i class="fas fa-plus  fa-sm text-white-50"></i> New Category</a> -->
  <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#addCategory" ><i class="fas fa-plus  fa-sm fa-fw mr-2 text-gray-400"></i>New Specification</a>
</div>
@if(Session::has('status'))
<div class="alert alert-info text-center">
    {{ Session::get('status') }}
</div>
@endif

<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="/add_new_spec" method="post" name="Spec">
      {{ csrf_field() }}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Specification</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="form-group">
            <select name="category" class="form-control form-control-user" id="exampleInputEmail1">
              <option value="">Select Category</option>
              @foreach($category as $cate)
              <option value="{{ $cate->category_id }}">{{ $cate->name }}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="txet" name="specification" class="form-control form-control-user" id="exampleInputEmail" placeholder="specification Name">
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
      <th>No. of Specification</th>
      <th>Status</th>
      <th>Action</th>
  <tfoot>
    <tr>
      <th>Name</th>
      <th>No. of Sub Specification</th>
      <th>Status</th>
      <th>Action</th>
  <tbody>

  @foreach($specification as $cate)
    <tr>
      <td>{{ $cate->name }}</td>
      <td>{{ $cate->count }}</td>
      <td class="{{ $cate->status=='1'?'text-success':'text-danger' }} font-weight-bolder">{{ $cate->status=='1'?'Active':'Inactive' }}</td>
      <td>
          <button class="btn btn-sm btn-primary icon-fas viewspec" data-id="{{ base64_encode($cate->category_id) }}"><i class="fas fa-eye "></i></button>
          <!-- <button class="btn btn-sm btn-danger icon-fas" title="Delete"><i class="fas fa-trash "></i></button> -->
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

<div class="modal fade" id="viewspec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="categoryname">Category Name</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="bg-warning text-white p-1">Note: Click the specification to manage it.</p>
          <div id="spec_list">
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
$("form[name='Spec']").validate({
    rules: {
      category: {
        required: true,
      },
      specification: {
        required: true,
        minlength: 3
      }
    },
    messages: {
      category: {
        required: "Please Select category name",
      },
      specification: {
        required: "Please enter sub category name",
        minlength: "Your sub category name must be at least 3 characters long"
      },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
$('.viewspec').click(function(){
  var id = $(this).attr('data-id');
  $.ajax({
      type: "Get",
      contentType: "application/json",
      url: "/get_cate_spec/"+id,
      success: function (result) {
        var data = $.parseJSON(result)
        $('#categoryname').text(data['category']);
        $('#spec_list').html(data['specification']);
        $('#viewspec').modal('show');
      }
  });
});
</script>


@endsection