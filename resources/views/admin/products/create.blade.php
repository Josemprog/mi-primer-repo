@extends('layouts.app')

@section('content')
<div class="row" style="padding: 10px">

  {{-- Administrator menu --}}
  <div class="col-2">
    @auth
    @if (Auth::user()->admin or Auth::user()->main_admin)
    {{-- Admi buttons --}}
    <div class="btn-group-vertical">
      <a class="btn btn-dark btn-lg" href="{{ route('products.index') }}">Back to Products</a>
    </div>
    @endif
    @endauth
  </div>

  <div class="col-10">


    <div class="container">
      <div class=" justify-content-center">
        <div class="col-md-10 p-edit-2">

          <h1 class="text-dark">Creating products</h1>
          {{-- {{$errors}} --}}
          <form method="POST" action=" {{ route('products.store')}} " class="form-group" enctype="multipart/form-data">
            @csrf

            <div class="row" style="padding: 10px">
              <div class="col-6">
                <label class="text-muted" for="brand">Brand</label>
                <input name="brand" id="brand" class="form-control" placeholder="Brand ..." value="{{old('brand')}}">
                {!! $errors->first('brand', '<small class="alert alert-danger">:message</small><br>') !!}

                <label class="text-muted" for="name">Name</label>
                <input name="name" id="name" class="form-control" placeholder="Name ..." value="{{old('name')}}">
                {!! $errors->first('name', '<small class="alert alert-danger">:message</small><br>') !!}

                <label class="text-muted" for="unit_price">Unit Price</label>
                <input name="unit_price" id="unit_price" class="form-control" placeholder="Unit price ..."
                  value="{{old('unit_price')}}">
                {!! $errors->first('unit_price', '<small class="alert alert-danger">:message</small><br>') !!}

                <label class="text-muted" for="quantity">Quantity</label>
                <input name="quantity" id="quantity" class="form-control" placeholder="Quantity ..."
                  value="{{old('quantity')}}">
                {!! $errors->first('quantity', '<small class="alert alert-danger">:message</small><br>') !!}

                <label class="text-muted" for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="5"
                  placeholder="Description ...">{{old('description')}}</textarea>
                {!! $errors->first('description', '<small class="alert alert-danger">:message</small><br>') !!}
              </div>

              <div class="col-6 d-flex flex-column justify-content-between">
                <h3 class="text-muted"> Image</h3>
                <img id="imagen" src="..." class="img-fluid wrapper" alt="Image">
                <div class="custom-file">
                  <input name="image" type="file" class="custom-file-input" id="customFile" value="{{old('image')}}">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                {!! $errors->first('image', '<small class="alert alert-danger">:message</small><br>') !!}
              </div>
            </div>



            <br>

            <button type="submit" class="btn btn-dark btn-lg btn-block">Create</button>

          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection