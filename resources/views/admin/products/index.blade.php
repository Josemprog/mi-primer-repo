@extends('layouts.app')

@section('content')
<div class="main-container">

  <div class="container-filter">
    <div class="container">
      {{-- Administrator menu --}}
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      {{-- buttons --}}
      <div>
        <a class="btn btn-dark mb-2" href="{{ route('products.create') }}">+ Create a new Product</a>
        <a class="btn btn-dark mb-2" href="{{ route('products.panel') }}">View admin panel</a>
        <a class="btn btn-dark mb-2" href="{{ route('users.index') }}">Manage Users</a>
      </div>
      @endif
      @endauth

      {{-- Filter form --}}
      <form class="form-group mt-3 p-edit" method="GET" action="{{route('products.index')}}">
        <h1 class="text-muted">Filter</h1>
        <small class="form-text text-muted">Search by Brand</small>
        <input type="text" class="form border" name="brand" placeholder="Brand ...">

        <small class="form-text text-muted">Search by name</small>
        <input type="text" class="form border" name="name" placeholder="Name ...">

        <small class="form-text text-muted">Search by price</small>
        <input type="text" class="form border" name="price" placeholder="Price ...">

        <button type="submit" class="btn btn-dark btn btn-block mt-2">Search</button>
      </form>

    </div>
  </div>

  {{-- Products container --}}
  <div class="container-products">

    <div class="card-group">
      @forelse ($products as $product)
      @if ($product->enabled == 1)

      {{-- Card Products --}}
      <div class="p-card">
        <div class="btn-edit">
          <h3 style="padding: 5px 0 0 10px">{{ $product->brand}}</h3>
          <div class="btn-group">
            @auth
            @if (Auth::user()->admin or Auth::user()->main_admin)
            <p>
              <button class="btn border-0" type="submit">
                <a href="{{ route('products.edit', $product)}}">
                  <i class="fas fa-pencil-alt text-primary"></i>
                </a>
              </button>
            </p>
            <form method="POST" action="{{ route('products.destroy', $product) }}" enctype="multipart/form-data">
              @csrf
              @method('DELETE')
              <button class="btn border-0">
                <i class="fas fa-trash-alt text-danger"></i>
              </button>
            </form>
            @endif
            @endauth
          </div>
        </div>
        {{-- Image --}}
        <div class="imagen-card">
          @if (substr($product->image, 0, 5) == 'https')
          <img src="{{$product->image}}" class="img-fluid" alt="Responsive image">
          @else
          <img src="/storage/{{$product->image}}" class="img-fluid" alt="Responsive image">
          @endif
        </div>

        {{-- Body --}}
        <div class="p-card-body">
          <div class="name-price-product">
            <a class="text-dark">{{ $product->name}}</a>
            <span class="text-success">${{ number_format($product->price)}}</span>
          </div>
          {{-- Buttons --}}
          <div class="p-card-btn">
            <a href="{{ route('products.show', $product) }}" class="btn btn-dark text-white"
              style="height: 35px">See</a>
            <form>
              <div class="btn-group" style="height: 35px">
                <button class="btn btn-success">Buy now</button>
                <button class="btn btn-success"><i class="fas fa-cart-plus"></i></button>
              </div>
            </form>
          </div>
          {{-- End Buttons --}}
        </div>
      </div>
      {{-- End Card Products --}}
      @endif
      @empty
      <h1>No hay productos ...</h1>
      @endforelse
    </div>

  </div>

</div>
{{-- Pagination --}}
<div class=" d-flex justify-content-center">{{ $products->render()}}</div>
@endsection