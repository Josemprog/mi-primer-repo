@extends('layouts.app')

@section('content')
<div class="main-container">

  {{-- Administrator menu --}}
  <div class="container-filter">
    <div class="container">

      {{-- botones del admin --}}
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      <div class="btn-group-vertical">
        <a class="btn btn-dark mb-2" href="{{ route('users.create') }}">+ Create a new account</a>
        <a class="btn btn-dark mb-2" href="{{ route('home') }}">Manage products</a>
        <a class="btn btn-dark mb-2" href="{{ route('products.index') }}">View products panel</a>
      </div>

      <div class="page-header mt-4 p-edit">
        <h1 class="text-muted">Filter</h1>

        <form class="form-group" method="GET" action="{{route('users.index')}}">
          @csrf
          <small class="form-text text-muted">Search by name</small>
          <input type="text" class="form border" name="name" placeholder="Name ...">

          <small class="form-text text-muted">Search byemail</small>
          <input type="text" class="form border" name="email" placeholder="Email ...">

          <div class="form-check pt-2">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="enabled" value="checkedValue">
              Search for disabled users
            </label>
          </div>

          <button type="submit" class="btn btn-dark btn btn-block mt-2">Search</button>
        </form>
      </div>

      @endif
      @endauth
    </div>
  </div>

  <div class="container-products">

    <div class="container">
      <h1 class="text-dark d-flex justify-content-center">Accounts Users</h1>
      <table class="table table-striped p-edit-2">
        <thead>
          <tr class="text-muted h5">
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Creation date</th>
            <th>Modification date</th>
            <th>Type</th>
            <th>State</th>
            <th>Set up</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td scope="row">{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
            <td>
              <button
                class=" justify-content-center btn-sm @if($user->admin) btn btn-outline-success @else btn btn-outline-secondary @endif "
                disabled>
                {{ $user->admin ? 'Admin' : 'User' }}
              </button>
            </td>
            <td>
              <button
                class=" justify-content-center btn-sm @if($user->enabled) btn btn-outline-success @else btn btn-outline-secondary @endif "
                disabled>
                {{ $user->enabled ? 'Enabled' : 'Disabled' }}
              </button>
            </td>
            <td>
              <div class="btn-group">
                <button class="btn">
                  <a href="{{ route('users.edit', $user) }}"><i class="fas fa-pencil-alt"></i></a>
                </button>
                <form method="POST" action="{{ route('users.destroy', $user) }}">
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
        {{ $users->appends(request()->query())->links()}}</div>

    </div>

  </div>
  @endsection