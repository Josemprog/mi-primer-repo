@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-2">
    <div class="container">
      {{-- Administrator menu --}}
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      {{-- buttons --}}
      <div class="btn-group-vertical">
        <a class="btn btn-primary btn-lg" href="{{ route('products.create') }}">Create a new Product</a>
        <a class="btn btn-primary btn-lg" href="{{ route('products.index') }}">View products as user</a>
        <a class="btn btn-primary btn-lg" href="{{ route('users.index') }}">Manage Users</a>
      </div>
      @endif
      @endauth

      {{-- Filter form --}}
      <form class="form-group mt-3 p-edit" method="GET" action="{{route('products.panel')}}">
        <h1 class="text-primary">Filter</h1>
        <small class="form-text text-muted">Search by Brand</small>
        <input type="text" class="form border" name="brand" placeholder="Brand ...">

        <small class="form-text text-muted">Search by name</small>
        <input type="text" class="form border" name="name" placeholder="Name ...">

        <small class="form-text text-muted">Search by price</small>
        <input type="text" class="form border" name="unit_price" placeholder="Price ...">

        <div class="form-check pt-2">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="enabled" value="checkedValue">
            Search for disabled products
          </label>
        </div>

        <button type="submit" class="btn btn-primary btn btn-block mt-2">Search</button>
      </form>
    </div>
  </div>

  <div class="col-10">

    <div class="container">
      <h1 class="text-primary d-flex justify-content-center h-big">Products</h1>
      <table class="table table-striped p-edit-2">
        <thead>
          <tr class="text-info">
            <th>Id</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Unit price</th>
            <th>Quantity</th>
            <th>Creation date</th>
            <th>Modification date</th>
            <th>State</th>
            <th>Set up</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
          <tr scope="row">
            <td>{{$product->id}}</td>
            <td>{{$product->brand}}</td>
            <td>{{$product->name}}</td>
            <td class="text-success">${{$product->unit_price}}</td>
            <td>{{$product->quantity}}</td>
            <td>{{$product->created_at}}</td>
            <td class="d-flex justify-content-center">...</td>
            <td>
              <button
                class=" justify-content-center btn-sm @if($product->enabled) btn btn-outline-success @else btn btn-outline-secondary @endif "
                disabled>
                {{ $product->enabled ? 'Enabled' : 'Disabled' }}
              </button>
            </td>
            <td>
              <div class="btn-group">
                <button class="btn">
                  <a href="{{ route('products.edit', $product) }}"><i class="fas fa-pencil-alt"></i></a>
                </button>
                <form method="POST" action="{{ route('products.destroy', $product) }}">
                  @csrf
                  @method('DELETE')
                  <button class="btn">
                    <i class=" fas fa-trash-alt text-danger"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{-- Pagination --}}
      <div class=" d-flex justify-content-center">{{ $products->render()}}</div>
    </div>
  </div>
</div>
@endsection