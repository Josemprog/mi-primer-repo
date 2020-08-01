@extends('layouts.app')

@section('content')
<div class="row" style="padding: 10px">

  {{-- Administrator menu --}}
  <div class="col-2">
    <div class="btn-group-vertical">
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      <a class="btn btn-primary" href="{{ route('products.create') }}">Create a new Product</a>
      <a class="btn btn-primary" href="{{ route('products.panel') }}">View admin panel</a>
      <a class="btn btn-primary" href="{{ route('users.index') }}">Manage Users</a>
      @endif
      @endauth
    </div>
  </div>

  {{-- Showing the products --}}
  <div class="col-10 justify-content-center row row-cols-md-3">

    {{-- Products container --}}
    @forelse ($products as $product)
    <div class="col mb-4">

      {{-- Card Products --}}
      <div class="card">

        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between">
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

        {{-- Image Card --}}
        <div class="imagen-card">
          <img src="/storage/{{$product->image}}" class="img-fluid" alt="Responsive image">
        </div>

        {{-- Card Body --}}
        <div class="card-body p-2">
          <h5 class="text-info">{{ $product->name}}</h5>
          <span class="text-success">${{ $product->unit_price}}</span>
        </div>

        {{-- Card Footer --}}
        <div class="card-footer d-flex justify-content-around">
          <button class="btn btn-info text-white">See</button>
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
    @empty
    <h1>No hay productos ...</h1>
    @endforelse

  </div>

</div>
@endsection