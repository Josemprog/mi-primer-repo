@extends('layouts.app')

@section('content')
<div class="main-container">

    <div class="container-filter">
        <div class="container">
            {{-- Administrator menu --}}
            @auth
            @if (Auth::user()->admin or Auth::user()->main_admin)
            {{-- buttons --}}
            <buttons-component></buttons-component>
            @endif
            @endauth

            {{-- Filter form --}}
            <form class="form-group mt-3 p-edit" method="GET" action="{{route('products.index')}}">
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

            <div>
                <product-panel></product-panel>
                @include('admin.api.edit')
            </div>
        </div>
    </div>
</div>
@endsection