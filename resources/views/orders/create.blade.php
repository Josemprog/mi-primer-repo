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
        <a class="btn btn-dark btn-lg mb-2" href="{{ route('products.index') }}">Back to Products</a>
        <a class="btn btn-dark btn-lg" href="{{ route('carts.index') }}">Back to Cart</a>
      </div>
      @endif
      @endauth
      <hr>

      <h3>Total to pay in the order<span class="badge badge-success">$ {{number_format($cart->total)}}</span></h3>

      <hr>
    </div>

  </div>

  <div class="container-products">

    <div class="container">
      <h1 class="text-dark d-flex justify-content-center h-big">Orders Details</h1>


      <div class="container d-flex flex-column justify-content-center">

        <div class="text-center">
          <form class="d-inline" method="POST" action="{{ route('orders.store') }}">
            @csrf
            <button class="btn btn-success btn-lg mb-3 w-auto" type="submit"> Confirm Oder </button>
          </form>
        </div>

        <table class="table table-striped p-edit-2 w-auto">
          <thead>
            <tr class="text-muted">
              <th>Id</th>
              <th>Img</th>
              <th>Brand</th>
              <th>Name</th>
              <th>Unit price of the product</th>
              <th>Quantity</th>
              <th>Total to pay for product</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cart->products as $product)
            <tr scope="row">
              <td>{{$product->id}}</td>
              <td class="img-panel">
                @if (substr($product->image, 0, 5) == 'https')
                <img src="{{$product->image}}" class="img-fluid" alt="Responsive image">
                @else
                <img src="/storage/{{$product->image}}" class="img-fluid" alt="Responsive image">
                @endif
              </td>
              <td>{{$product->brand}}</td>
              <td>{{$product->name}}</td>
              <td class="text-success">${{number_format($product->price)}}</td>
              <td>{{$product->pivot->quantity}}</td>
              <td class="text-success">${{ number_format($product->total) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- Pagination --}}
      {{-- <div class=" d-flex justify-content-center">{{ $products->render()}}
    </div> --}}
  </div>
</div>
</div>
@endsection