@extends('layout.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Products</h1>
  <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="/Add_Product"><i class="fas fa-plus  fa-sm fa-fw mr-2 text-gray-400"></i>New Product</a>
</div>
@if(Session::has('status'))
<div class="alert alert-info text-center">
    {{ Session::get('status') }}
</div>
@endif

<table class="table table-bordered table-sm table-hover" id="dataTable" width="100%">
  <thead>
    <tr>
      <th>Name</th>
      <th>Category</th>
      <th>Sub Category</th>
      <th>Price</th>
      <th>Status</th>
      <th>Action</th>
  <tfoot>
    <tr>
      <th>Name</th>
      <th>Category</th>
      <th>Sub Category</th>
      <th>Price</th>
      <th>Status</th>
      <th>Action</th>
  <tbody>
  @foreach($products as $product)
    <tr>
      <td>{{ $product->name }}</td>
      <td>{{ $product->category }}</td>
      <td>{{ $product->subcategory }}</td>
      <td>{{ $product->price }}</td>
      <td class="{{ $product->status=='1'?'text-success':'text-danger' }} font-weight-bolder">{{ $product->status=='1'?'Active':'Inactive' }}</td>
      <td>
          <a href="/Edit_Product/{{ base64_encode($product->product_id) }}" class="btn btn-sm btn-info icon-fas" title="Edit"><i class="fas fa-edit "></i></a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

@endsection