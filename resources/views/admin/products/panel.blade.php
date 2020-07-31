@extends('layouts.app')

@section('content')
<div class="row" style="padding: 10px">

  <div class="col-2">
    <div class="btn-group-vertical">
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      <a class="btn btn-primary" href="{{ route('products.create') }}">Create a new Product</a>
      <a class="btn btn-primary" href="{{ route('products.index') }}">view products as user</a>
      <a class="btn btn-primary" href="{{ route('users.index') }}">Manage Users</a>
      @endif
      @endauth
    </div>
  </div>

  <div class="col-10">

    <div class="container">
      <div class=" justify-content-center">
        <div class="col-md-10">
          <table class="table table-striped">
            <thead>
              <tr class="text-info">
                <th>Id</th>
                <th>Brand</th>
                <th>Name</th>
                <th>Unit price</th>
                <th>Quantity</th>
                {{-- <th>image</th> --}}
                {{-- <th>State</th> --}}
                <th>Set up</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr scope="row">
                <td>{{$product->id}}</td>
                <td>{{$product->brand}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->unit_price}}</td>
                <td>{{$product->quantity}}</td>
                {{-- <td>{{$product->image}}</td> --}}
                {{-- <td>{{$product->enabled}}</td> --}}
                <td>
                  <div class="btn-group">
                    <p><button class="btn btn-outline-primary">
                        <a href="{{ route('products.edit', $product) }}"><i class="fas fa-pencil-alt"></i></a>
                      </button></p>
                    <form method="POST" action="{{ route('products.destroy', $product) }}">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-outline-danger">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  @endsection