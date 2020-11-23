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
                <a class="btn btn-dark mb-2" href="{{ route('products.create') }}">+ Create a new Product</a>
                <a class="btn btn-dark mb-2" href="{{ route('products.index') }}">View products as user</a>
                <a class="btn btn-dark mb-2" href="{{ route('users.index') }}">Manage Users</a>
            </div>
            @endif
            @endauth

            {{-- Filter form --}}
            <form class="form-group mt-3 p-edit" method="GET" action="{{route('products.panel')}}">
                <h1 class="text-muted">Filter</h1>
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

                <button type="submit" class="btn btn-dark btn btn-block mt-2">Search</button>
            </form>
        </div>
    </div>

    <div class="container-products">

        <div class="container">
            <h1 class="text-dark d-flex justify-content-center h-big">Products</h1>

            {{-- Buttons to export and import --}}

            <div class=" d-flex justify-content-between m-2">
                <div>
                    <a class="btn btn-primary" href="{{ route('products.export') }}">Exportar</a>
                </div>

                <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="input-group">
                        <div class="custom-file">
                            <input name="file" type="file" class="custom-file-input" id="inputGroupFile04"
                                aria-describedby="inputGroupFileAddon04">
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                        </div>
                        {{-- <div class="input-group-append"> --}}
                        <button class="btn btn-primary ml-2" type="submit" id="inputGroupFileAddon04">Importar</button>
                        {{-- </div> --}}
                    </div>
                    @csrf
                </form>
            </div>

            <table class="table table-striped p-edit-2">
                <thead>
                    <tr class="text-muted">
                        <th>Id</th>
                        <th></th>
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
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->updated_at}}</td>
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
                                    <a href="{{ route('products.edit', $product) }}"><i
                                            class="fas fa-pencil-alt"></i></a>
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