@extends('layouts.app')

<style>
  .contenedor {
    jus
  }
</style>

@section('content')
<div class="row" style="padding: 10px">

  <div class="col-2">
    <div class="btn-group-vertical">
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      <a class="btn btn-primary" href="{{ route('products.index') }}">Back to Products</a>
      <a class="btn btn-primary" href="{{ route('products.panel') }}">Back to admin panel</a>
      <a class="btn btn-primary" href="{{ route('users.index') }}">Manage Users</a>
      @endif
      @endauth
    </div>
  </div>

  <div class="col-10">


    <div class="container">
      <div class=" justify-content-center">
        <div class="col-md-10">

          <h1 class="text-info">Edit Product <span style="color:rgb(39, 86, 161)">{{ $product->name}}</span></h1>
          <form method="POST" action=" {{ route('products.update', $product)}} " class="form-group"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row" style="padding: 10px">
              <div class="col-6">
                <label class="text-info" for="brand">Brand</label>
                <input name="brand" id="brand" class="form-control" value="{{ $product->brand}}">

                <label class="text-info" for="name">Name</label>
                <input name="name" id="name" class="form-control" value="{{ $product->name}}">

                <label class="text-info" for="unit_price">Unit Price</label>
                <input name="unit_price" id="unit_price" class="form-control" value="{{ $product->unit_price}}">

                <label class="text-info" for="quantity">Quantity</label>
                <input name="quantity" id="quantity" class="form-control" value="{{ $product->quantity}}">

                <label class="text-info" for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30"
                  rows="5">{{ $product->description}}</textarea>
              </div>

              <div class="col-6 d-flex flex-column justify-content-between">
                <h3 class="text-info"> Image</h3>
                <img id="imagen" src="/storage/{{$product->image}}" class="img-fluid wrapper" alt="Image">
                <div class="custom-file">
                  <input name="image" type="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
              </div>
            </div>



            <br>

            <button type="submit" class="btn btn-info btn-lg btn-block">Edit</button>

          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection