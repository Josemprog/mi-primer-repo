@extends('layouts.app')

@section('content')
<div class="row">

  {{-- Administrator menu --}}
  <div class="col-2 ml-3">
    {{-- Admi buttons --}}
    <div class="btn-group-vertical">
      <a class="btn btn-primary btn-lg" href="{{ route('products.index') }}">Back to products</a>
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      <a class="btn btn-primary btn-lg" href="{{ route('products.panel') }}">View admin panel</a>
      <a class="btn btn-primary btn-lg" href="{{ route('users.index') }}">Manage Users</a>
      @endif
      @endauth
    </div>
  </div>

  {{-- Showing the products --}}
  <div class="col-10 justify-content-center row row-cols-md-3">

    {{-- Products container --}}
    <h1 class="text-primary">{{$product->name}}</h1>
    <img id="imagen" src="/storage/{{$product->image}}" class="img-fluid wrapper" alt="Image">

  </div>

</div>
@endsection