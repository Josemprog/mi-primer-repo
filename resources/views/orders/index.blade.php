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
    </div>

  </div>

  <div class="container-products">

    <div class="container">
      <h1 class="text-dark d-flex justify-content-center h-big">Orders Details</h1>


      <div class="container d-flex flex-column justify-content-center">

        <table class="table table-striped p-edit-2 w-auto">
          <thead>
            <tr class="text-muted">
              <th>requestId</th>
              <th>Status</th>
              <th>Customer id</th>
              <th>created_at</th>
              <th>updated_at</th>
              <th>set up</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
            <tr scope="row">
              <td>{{$order->requestId}}</td>
              <td>{{$order->status}}</td>
              <td>{{$order->customer_id}}</td>
              <td>{{$order->created_at}}</td>
              <td>{{$order->updated_at}}</td>
              <td>
                <a href="{{ route('orders.show', $order) }}" class="btn btn-dark text-white"
                  style="height: 35px">See</a>
              </td>
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