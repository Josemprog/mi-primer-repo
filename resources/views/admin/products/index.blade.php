@extends('layouts.app')

@section('content')
<div class="main-container">

    <div class="container-filter">
        <div class="container">
            {{-- Administrator menu --}}
            @auth
            @if (Auth::user()->admin or Auth::user()->main_admin)
            {{-- buttons --}}
            <div class="btn-group-vertical">
                <a class="btn btn-dark mb-2" href="{{ route('products.create') }}">+ Create a new Product</a>
                <a class="btn btn-dark mb-2" href="{{ route('home') }}">View products as user</a>
                <a class="btn btn-dark mb-2" href="{{ route('users.index') }}">Manage Users</a>
            </div>
            @endif
            @endauth

            {{-- Filter form --}}
            <form class="p-edit mt-4" method=" GET" action="{{route('products.index')}}">
                @csrf
                <h1 class="text-muted">Filter</h1>
                <div class="mb-2">
                    <div id="brandHelp" class="form-text text-muted">Search by Brand.</div>
                    <input type="text" name="brand" placeholder="Brand ..." class="form-control" id="brand"
                        aria-describedby="brandHelp">
                </div>
                <div class="mb-2">
                    <div id="brandHelp" class="form-text text-muted">Search by Name.</div>
                    <input type="text" name="name" placeholder="Name ..." class="form-control" id="name"
                        aria-describedby="nameHelp">
                </div>
                <div class="mb-2">
                    <div id="priceHelp" class="form-text text-muted">Search by price.</div>
                    <input type="text" name="price" placeholder="Price ..." class="form-control" id="price"
                        aria-describedby="priceHelp">
                </div>
                <div class="mb-2 form-check">
                    <input type="checkbox" name="enabled" value="checkedValue" class="form-check-input"
                        id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Search for disabled products</label>
                </div>
                <button type="submit" class="btn btn-dark btn-block">Search</button>
            </form>
        </div>
    </div>

    <div class="container-products">

        <div class="container">
            <h1 class="text-dark d-flex justify-content-center h-big">Products</h1>

            {{-- Buttons to export and import --}}
            @if (Auth::user()->hasRole('main-admin'))
            <div class=" d-flex justify-content-between m-2">
                <div>
                    <a class="btn btn-primary" href="{{ route('products.export') }}">Export</a>
                </div>

                <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="input-group">
                        <div class="custom-file">
                            <input name="importFile" type="file" class="custom-file-input" id="inputGroupFile04"
                                aria-describedby="inputGroupFileAddon04">
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                        </div>
                        {{-- <div class="input-group-append"> --}}
                        <button class="btn btn-primary ml-2" type="submit" id="inputGroupFileAddon04">Import</button>
                        {{-- </div> --}}
                    </div>
                    @csrf
                </form>
            </div>
            @endif

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
                        <td>{{$product->created_at->diffForHumans()}}</td>
                        <td>{{$product->updated_at->diffForHumans()}}</td>
                        <td>
                            <button
                                class=" justify-content-center btn-sm @if($product->enabled) btn btn-outline-success @else btn btn-outline-secondary @endif "
                                disabled>
                                {{ $product->enabled ? 'Enabled' : 'Disabled' }}
                            </button>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn text-primary" href="{{ route('products.edit', $product) }}"><i
                                        class="fas fa-pencil-alt"></i></a>
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
            <div class=" d-flex justify-content-center mt-3">
                {{ $products->appends(request()->query())->links()}}</div>
        </div>
    </div>
</div>
@endsection