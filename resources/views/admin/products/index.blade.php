@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-2">
    <div class="container">
      {{-- Administrator menu --}}
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      {{-- buttons --}}
      <div class="btn-group-vertical">
        <a class="btn btn-primary btn-lg" href="{{ route('products.create') }}">Create a new Product</a>
        <a class="btn btn-primary btn-lg" href="{{ route('products.panel') }}">View admin panel</a>
        <a class="btn btn-primary btn-lg" href="{{ route('users.index') }}">Manage Users</a>
      </div>
      @endif
      @endauth

      {{-- Filter form --}}
      <form class="form-group mt-3" method="GET" action="{{route('products.index')}}">
        <h1>Filter</h1>
        <small class="form-text text-muted">Search by Brand</small>
        <input type="text" class="form border" name="brand" placeholder="Brand ...">

        <small class="form-text text-muted">Search by name</small>
        <input type="text" class="form border" name="name" placeholder="Name ...">

        <small class="form-text text-muted">Search by price</small>
        <input type="text" class="form border" name="unit_price" placeholder="Price ...">

        <button type="submit" class="btn btn-primary btn btn-block mt-2">Search</button>
      </form>

    </div>
  </div>

  {{-- Showing the products --}}
  <div class="col-10 justify-content-center row row-cols-md-3">

    {{-- Products container --}}
    @forelse ($products as $product)
    @if ($product->enabled == 1)
    <div class="col mb-4">

      {{-- Card Products --}}
      <div class="card">

        {{-- Header --}}
        <div class="d-flex justify-content-between p-2">
          <h2 class="text-primary">{{ $product->brand}}</h2>

          {{-- Header Buttons --}}
          <div class="btn-group">
            @auth
            @if (Auth::user()->admin or Auth::user()->main_admin)
            <p>
              <button class="btn btn-outline-info border-0" type="submit">
                <a href="{{ route('products.edit', $product)}}">
                  <i class="fas fa-pencil-alt"></i>
                </a>
              </button>
            </p>
            <form method="POST" action="{{ route('products.destroy', $product) }}">
              @csrf
              @method('DELETE')
              <button class="btn btn-outline-danger border-0">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
            @endif
            @endauth
          </div>
        </div>

        {{-- Image --}}
        <div class="imagen-card">
          <img src="/storage/{{$product->image}}" class="img-fluid" alt="Responsive image">
        </div>

        {{-- Body --}}
        <div class="card-body p-2">
          <h5 class="text-info">{{ $product->name}}</h5>
          <span class="text-success">${{ $product->unit_price}}</span>
          <hr>
        </div>

        {{-- Footer --}}
        <div class="d-flex justify-content-around pb-3">
          <a href="{{ route('products.show', $product) }}" class="btn btn-info text-white">See</a>
          {{-- Footer Buttons --}}
          <div class="btn-group">
            <button class="btn btn-success">Buy now</button>
            <button class="btn btn-success">
              <i class="fas fa-cart-plus" style="font-size: 1.5em"></i>
            </button>
          </div>
        </div>
      </div>

      {{-- End Card Products --}}
    </div>
    @endif
    @empty
    <h1>No hay productos ...</h1>
    @endforelse
    {{-- Pagination --}}
  </div>

</div>
<div class=" d-flex justify-content-center">{{ $products->render()}}</div>
@endsection