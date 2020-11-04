@extends('layouts.app')

@section('content')
<div class="main-container">

  <div class="container-filter">
    <div class="container">
      {{-- Administrator menu --}}
      @auth
      {{-- buttons --}}
      <div>
        <a class="btn btn-dark btn-lg mb-2" href="{{ route('carts.index') }}">Back to Cart</a>
        <a class="btn btn-dark btn-lg mb-2" href="{{ route('products.index') }}">Go to Products</a>
      </div>
      @endauth
    </div>

  </div>

  <div class="container-products">

    <div class="container">
      <h1 class="text-dark d-flex justify-content-center h-big">Orders Details</h1>


      <div class="container d-flex flex-column justify-content-center">
        @if ($orders->isEmpty())
        <div class="alert alert-warning">
          You have no orders
        </div>
        @else
        <table class="table table-striped p-edit-2 w-auto">
          <thead>
            <tr class="text-muted">
              <th>requestId</th>
              <th>state</th>
              <th>Order id</th>
              <th>created at</th>
              <th>view orders</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
            <tr scope="row">
              <td>{{$order->requestId}}</td>
              <td>{{$order->state}}</td>
              <td>{{$order->id}}</td>
              <td>{{$order->created_at}}</td>
              <td>
                <a href="{{ route('orders.show', $order) }}" class="btn btn-dark text-white"
                  style="height: 35px">See</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection