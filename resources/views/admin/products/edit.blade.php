@extends('layouts.app')

@section('content')
<div class="row" style="padding: 10px">

  {{-- Administrator menu --}}
  <div class="col-2">
    @auth
    @if (Auth::user()->admin or Auth::user()->main_admin)
    {{-- Admi buttons --}}
    <div>
      <a class="btn btn-dark btn-lg mb-2" href="{{ route('products.index') }}">Back to Products</a>
      <a class="btn btn-dark mb-2" href="{{ route('products.panel') }}">Back to admin panel</a>
    </div>
    @endif
    @endauth
  </div>

  <div class="col-10">


    <div class="container">
      <div class=" justify-content-center">
        <div class="col-md-10 p-edit-2">

          <h1 class="text-dark">Edit Product <span style="color:rgb(39, 86, 161)">{{ $product->name}}</span></h1>
          <form method="POST" action=" {{ route('products.update', $product)}} " class="form-group"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row" style="padding: 10px">
              <div class="col-6">
                <label class="text-muted" for="brand">Brand</label>
                <input name="brand" id="brand" class="form-control" value="{{ $product->brand}}">
                {!! $errors->first('brand', '<small class="alert alert-danger">:message</small><br>') !!}

                <label class="text-muted" for="name">Name</label>
                <input name="name" id="name" class="form-control" value="{{ $product->name}}">
                {!! $errors->first('name', '<small class="alert alert-danger">:message</small><br>') !!}

                <label class="text-muted" for="unit_price">Unit Price</label>
                <input name="unit_price" id="unit_price" class="form-control" value="{{ $product->unit_price}}">
                {!! $errors->first('unit_price', '<small class="alert alert-danger">:message</small><br>') !!}

                <label class="text-muted" for="quantity">Quantity</label>
                <input name="quantity" id="quantity" class="form-control" value="{{ $product->quantity}}">
                {!! $errors->first('quantity', '<small class="alert alert-danger">:message</small><br>') !!}

                <label class="text-muted" for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30"
                  rows="5">{{ $product->description}}</textarea>
                {!! $errors->first('description', '<small class="alert alert-danger">:message</small><br>') !!}
              </div>

              <div class=" image-edit col-6 d-flex flex-column justify-content-between">
                <h3 class="text-muted"> Image</h3>
                <img id="imagen" src="/storage/{{$product->image}}" alt="Image">
                <div class="custom-file">
                  <input name="image" type="file" class="custom-file-input" id="customFile">
                  {!! $errors->first('image', '<small class="alert alert-danger">:message</small><br>') !!}
                  <label class="custom-file-label" for="customFile"></label>
                </div>
              </div>
            </div>

            <br>

            <select class="btn btn-warning btn-lg btn-block dropdown-toggle" name="enabled">

              @if ($product->enabled)
              <option value=1>Enabled</option>
              <option value=0>Disabled</option>
              @else
              <option value=1>Enabled</option>
              <option value=0 selected>Disabled</option>
              @endif
            </select>

            <br>

            <button type="submit" class="btn btn-dark btn-lg btn-block">Edit</button>

          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection