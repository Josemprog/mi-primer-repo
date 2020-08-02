@extends('layouts.app')

@section('content')
<div class="row" style="padding: 10px">

  {{-- Administrator menu --}}
  <div class="col-2">
    @auth
    @if (Auth::user()->admin or Auth::user()->main_admin)
    {{-- Admi buttons --}}
    <div class="btn-group-vertical">
      <a class="btn btn-primary btn-lg" href="{{ route('products.index') }}">Back to Products</a>
      <a class="btn btn-primary btn-lg" href="{{ route('products.panel') }}">Back to admin panel</a>
    </div>
    @endif
    @endauth
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
                  <label class="custom-file-label" for="customFile">{{$product->image}}</label>
                </div>
              </div>
            </div>

            <br>

            <select class="btn btn-warning btn-lg btn-block dropdown-toggle" name="select" id="select">

              @if ($product->enabled)
              <option value=1 selected>Enabled</option>
              <option value=0>Disabled</option>
              @else
              <option value=1>Enabled</option>
              <option value=0 selected>Disabled</option>
              @endif
            </select>



            <br>

            <button type="submit" class="btn btn-info btn-lg btn-block">Edit</button>

          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection