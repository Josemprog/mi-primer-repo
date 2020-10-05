@extends('layouts.app')

@section('content')
<div class="row">

  {{-- Administrator menu --}}
  <div class="col-2 ml-3">
    {{-- Admi buttons --}}
    <div class="btn-group-vertical">
      <a class="btn btn-dark btn-lg" href="{{ route('products.index') }}">Back to products</a>
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      <a class="btn btn-dark btn-lg" href="{{ route('products.panel') }}">View admin panel</a>
      <a class="btn btn-dark btn-lg" href="{{ route('users.index') }}">Manage Users</a>
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
          <h1 class="text-dark h-big">{{$order->requestId}}</h1>
        </div>

      </div>
    </div>

  </div>

</div>
@endsection