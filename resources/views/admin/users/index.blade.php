@extends('layouts.app')

@section('content')
<div class="row" style="padding: 10px">

  <div class="col-2">
    <div class="btn-group-vertical">
      <a class="btn btn-secondary" href="{{ route('users.create') }}">Create a new account</a>
    </div>
  </div>

  <div class="col-10">

    <div class="container">
      <div class=" justify-content-center">
        <div class="col-md-10">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>State</th>
                <th style="display: flex; justify-content: center;">Set up</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td scope="row">{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
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
                  <div class="btn-group" style="display: flex; justify-content: center;">
                    <form method="POST" action="{{ route('users.destroy', $user) }}">
                      @csrf
                      @method('DELETE')
                      <a href="{{ route('users.edit', $user) }}" type="button"
                        class="btn btn-outline-info btn-sm">Edit</a>
                      <input type="submit" class="btn btn-outline-danger btn-sm" value="Remove">
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