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
      </div>
      @endif
      @endauth

    </div>

  </div>

  <div class="container-products">

    <div class="container">
      <h1 class="text-dark d-flex justify-content-center h-big">Payments Details</h1>


      <div class="container d-flex flex-column justify-content-center">

        <div class="text-center">
          <form class="d-inline" method="POST" action="{{ route('orders.payments.store', [
            'order' => $order
          ]) }}">
            @csrf

            <textarea name="textArea" cols="30" rows="10"></textarea>
            <button class="btn btn-success btn-lg mb-3 w-auto" type="submit"> Pay </button>
          </form>

          <hr>

          <h3>Total to pay in the order <span class="badge badge-success">$ {{number_format($order->total)}}</span></h3>

          <hr>
        </div>




      </div>
    </div>
  </div>
</div>
@endsection