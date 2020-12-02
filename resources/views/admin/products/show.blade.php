@extends('layouts.app')

@section('content')
<div class="row">

  {{-- Administrator menu --}}
  <div class="col-2 ml-3">
    {{-- Admi buttons --}}
    <div>
      <a class="btn btn-dark btn-lg mb-2" href="{{ route('home') }}">Back to products</a>
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      <a class="btn btn-dark mb-2" href="{{ route('products.index') }}">View admin panel</a>
      <a class="btn btn-dark mb-2" href="{{ route('users.index') }}">Manage Users</a>
      @endif
      @endauth
    </div>
  </div>

  {{-- Showing the products --}}
  <div class="col-10 justify-content-center row ">

    {{-- Products container --}}
    <div class="row">
      <div class="col-5">
        <div class="container">
          <h1 class="text-dark h-big">{{$product->name}}</h1>
          <h4 class="text-primary">{{$product->brand}}</h4>
          <h2 class="text-success">${{number_format($product->price)}}</h2>
          <h4 class="text-dark">Description</h4>
          <p class="p-edit">{{$product->description}} {{ $product->description }} {{ $product->description }}
            {{ $product->description }}</p>
        </div>

      </div>
      <div class="col-5 d-flex flex-column">
        <div class="image-show">
          @if (substr($product->image, 0, 5) == 'https')
          <img src="{{$product->image}}" class="img-fluid" alt="Responsive image">
          @else
          <img src="/storage/images/{{$product->image}}" class="img-fluid" alt="Responsive image">
          @endif
        </div>
        <form method="POST" action="{{ route('products.carts.store', ['product' => $product->id]) }}">
          @csrf
          <div class="btn-group btn-block">
            <button class="btn btn-success btn-big"><span class="h1">Buy now</span></button>
            <button class="btn btn-success btn-bigr">
              <i class="fas fa-cart-plus h-big"></i>
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>

</div>
@endsection