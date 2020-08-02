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
  <div class="col-10 justify-content-center row ">

    {{-- Products container --}}
    <div class="row">
      <div class="col-5">
        <div class="container">
          <h1 class="text-primary h-big">{{$product->name}}</h1>
          <h4 class="text-muted">{{$product->brand}}</h4>
          <h2 class="text-success">${{$product->unit_price}}</h2>
          <h4 class="text-info">Description</h4>
          <p class="p-edit">{{$product->description}}, Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque
            expedita maxime,
            perferendis tempore odit officia velit a aut, numquam error distinctio minus, recusandae optio. Dolor,
            deserunt id sunt laboriosam aperiam corporis totam illum mollitia magnam atque molestiae consectetur fuga!
            Id quisquam quia hic sequi repudiandae ut molestiae facere nostrum fugit architecto consectetur maxime,
            perferendis nulla officia repellat totam, quidem non quam aperiam! Similique molestiae, doloribus dolorem
            porro nobis eius explicabo amet quisquam distinctio voluptatem sapiente reprehenderit voluptas neque
            commodi. Quaerat sunt inventore consequuntur exercitationem voluptatum quo deserunt sit quisquam molestias
            in, numquam, voluptas repellendus accusantium. Rerum alias corrupti quas consequatur!</p>
        </div>

      </div>
      <div class="col-5 d-flex flex-column">
        <div class="img">
          <img id="imagen" src="/storage/{{$product->image}}" class="img-fluid wrapper" alt="Image">
        </div>
        {{-- Footer Buttons --}}
        <div class="btn-group">
          <button class="btn btn-success btn-big"><span class="h1">Buy now</span></button>
          <button class="btn btn-success btn-bigr">
            <i class="fas fa-cart-plus h-big"></i>
          </button>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection