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
                @include('admin.api.create')
                @include('admin.api.edit')
            </div>
        </div>
    </div>
</div>
@endsection