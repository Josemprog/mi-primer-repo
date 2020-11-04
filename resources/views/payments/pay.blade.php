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

    <hr>

    <h3>Total to pay in the order <span class="badge badge-success">$ {{number_format($cart->total)}}</span></h3>

    <hr>

  </div>

  <div class="container-products">

    <div class="container">
      <h1 class="text-dark d-flex justify-content-center h-big">Payments Details</h1>


      <div class="container d-flex flex-column justify-content-center">

        <div class="text-center">
          <form class="form-group d-flex justify-content-center" method="POST" action="{{ route('orders.store') }}">
            @csrf

            <div class="d-flex flex-column w-50">
              <textarea name="textArea" cols="40" rows="6" disabled> Agregar una descripción basada en la orden.
              </textarea>
              <button class="btn btn-success btn-lg mb-3 w-auto" type="submit"> Pay </button>

            </div>

          </form>
        </div>




      </div>
    </div>
  </div>
</div>
@endsection