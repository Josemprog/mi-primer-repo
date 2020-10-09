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
        @csrf
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

      {{------------------------- Card Products -------------------------}}
      <div class="p-card mb-4">
        <div class="d-flex justify-content-between">
          {{------------------------- Brand Product -------------------------}}
          <h3 class="pl-1 pt-1">{{$product->brand}}</h3>

          {{---------------------- Admin buttons--------------------------}}
          @auth
          @if (Auth::user()->admin or Auth::user()->main_admin)
          <div class="btn-group">
            <a class="btn" href="{{ route('products.edit', $product)}}">
              <i class="fas fa-pencil-alt text-primary"></i>
            </a>
            <form method="POST" action="{{ route('products.destroy', $product) }}" enctype="multipart/form-data">
              @csrf
              @method('DELETE')
              <button class="btn border-0">
                <i class="fas fa-trash-alt text-danger"></i>
              </button>
            </form>
          </div>
          @endif
          @endauth
        </div>
        {{---------------------- Product image--------------------------}}
        <div class="imagen-card">
          @if (substr($product->image, 0, 5) == 'https')
          <img src="{{$product->image}}" class="img-fluid" alt="Responsive image">
          @else
          <img src="/storage/{{$product->image}}" class="img-fluid" alt="Responsive image">
          @endif
        </div>
        <div>
          {{---------------------- Name and price of product--------------------------}}
          <div class="d-flex justify-content-between" style="height: 32px;">
            <h5 class="text-dark pl-1 pt-1">{{ $product->name}}</h5>
            <span class="text-success pr-1 pt-1">${{ number_format($product->price)}}</span>
          </div>

          {{---------------------- Cart buttons--------------------------}}
          <div class="container">
            <form class="btn-group btn-block" method="POST"
              action="{{ route('products.carts.store', ['product' => $product]) }}">
              @csrf
              <div class="btn-group btn-block ">
                <a href="{{ route('products.show', $product) }}" class="btn btn-dark text-white rounded">
                  See
                </a>
                <button type="submit" class="btn btn-success">
                  <i class="fas fa-cart-plus"></i>
                </button>
              </div>
            </form>
          </div>
          {{---------------------- End of Cart buttons--------------------------}}
        </div>
      </div>
      {{-- <div class="p-card">
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
    Image
    <div class="imagen-card">
      @if (substr($product->image, 0, 5) == 'https')
      <img src="{{$product->image}}" class="img-fluid" alt="Responsive image">
      @else
      <img src="/storage/{{$product->image}}" class="img-fluid" alt="Responsive image">
      @endif
    </div>

    Body
    <div class="p-card-body d-flex flex-column">
      <div class="name-price-product">
        <h5 class="text-dark pl-1">{{ $product->name}}</h5>
        <span class="text-success">${{ number_format($product->price)}}</span>
      </div>
      Buttons
      <div class="d-flex justify-content-between">
        <a href="{{ route('products.show', $product) }}" class="btn btn-dark text-white" style="height: 35px">See</a>
        <form method="POST" action="{{ route('products.carts.store', ['product' => $product]) }}">
          @csrf
          <div class="btn-group btn-block" style="height: 35px">
            <button type="submit" class="btn btn-success">Buy now</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-cart-plus"></i></button>
          </div>
        </form>
      </div>
      End Buttons
    </div>
  </div> --}}
  {{-- End Card Products --}}
  @endif
  @empty
  <h1>No hay productos ...</h1>
  @endforelse
</div>

</div>

</div>
{{-- Pagination --}}
<div class=" d-flex justify-content-center mt-3">
  {{ $products->appends(request()->query())->links()}}</div>
@endsection