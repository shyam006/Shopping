@extends('layout.app')

@section('content')
@foreach($product as $product)
@endforeach
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">{{ $product->name }}</h1>
  <a class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" href="/Product">Back</a>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <image height="100px" width="auto" src="{{ asset('assets/uploads/products/'.$product->product_id.'/'.$product->primary_pic) }}">
        </div>
        @foreach(json_decode($product->pics) as $secondary)
        <div class="col">
            <image height="100px" width="auto" src="{{ asset('assets/uploads/products/'.$product->product_id.'/'.$secondary) }}">
        </div>
        @endforeach
    </div>
    <div class="breadcrumb mt-5">
        <h5 class="mb-0"><b>{{ $category }}</b> / {{ $subcategory }}</h5>
    </div>
    <div class="description">
        <h4>Description</h4>
        <pre>{{ $product->description }}</pre>
    </div>
    <div class="specification">
        <h4>Specification</h4>
            @foreach($product_specification as $spec)
                <div class="row col-6">
                    <div class="col">
                        <label>{{ $spec->name }}</label>
                    </div>
                    <div class="col">
                        <label>{{ $spec->value }}</label>
                    </div>
                </div>
            @endforeach
    </div>
    <div class="delete edit text-right">
        <button type="button" class="btn btn-danger btn-user" data-toggle="modal" data-target="#delete_cate" style="min-width:100px">Delete</button>
    </div>  
</div>

<div class="modal fade" id="delete_cate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you sure? Do you want to delete this Product. ?</p>
        </div>
        <div class="modal-footer">
            <a href="/Delete_product/{{ base64_encode($product->product_id) }}" class="btn btn-danger">Delete</a>
        </div>
        </div>
    </div>
</div>

@endsection