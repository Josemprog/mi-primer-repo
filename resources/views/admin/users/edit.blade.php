@extends('layouts.app')

@section('content')
<div class="row" style="padding: 10px">

  <div class="col-2">
    @auth
    @if (Auth::user()->admin or Auth::user()->main_admin)
    <div class="btn-group-vertical">
      <a class="btn btn-dark btn-lg" href="{{ route('users.index') }}">Back to accounts</a>
    </div>
    @endif
    @endauth
  </div>

  <div class="col-10">

    <div class="container">
      <div class="d-flex col-md-10 p-edit-2">
        <div class="container">
          <h1 class="text-dark">Editing User <span style="color:rgb(39, 86, 161)">{{ $user->name }}</span></h1>
          <form method="POST" action="{{ route('users.update', $user) }}" class="form-group">
            @csrf
            @method('PATCH')

            <label class="text-muted" for="id">Id</label>
            <input name="id" class="form-control" value="{{ $user->id }}" disabled>

            <label class="text-muted" for="name">Name</label>
            <input style="border: rgba(122, 122, 122, 0.591) solid 1px" type="text" name="name" id="name"
              class="form-control" value="{{ $user->name }}">
            {!! $errors->first('name', '<small class="alert alert-danger">:message</small><br>') !!}

            <label class="text-muted" for="email">Email</label>
            <input name="email" class="form-control" value="{{ $user->email }}" disabled>

            <br>

            <select class="btn btn-warning btn-lg btn-block dropdown-toggle" name="enabled">

              @if ($user->enabled)
              <option value=1 selected>Enabled</option>
              <option value=0>Disabled</option>
              @else
              <option value=1>Enabled</option>
              <option value=0 selected>Disabled</option>
              @endif
            </select>

            <button type="submit" class="btn btn-dark btn-lg btn-block">Edit User</button>

          </form>
        </div>

        {{-- Roles y permisos --}}
        <div class="container border-left border-white">
          <div class="box box-primary">
            <div class="box-header">
              <h1 class="box-title">Roles</h1>
            </div>
            <div class="box-body">
              <form method="POST" action="{{ route('roles.update', $user) }}">
                @csrf @method('PUT')
                @foreach ($roles as $id => $name)
                <div class="checkbox">
                  <label>
                    <input name="roles" type="checkbox" value="{{ $id }}"
                      {{ $user->roles->contains($id) ? 'checked' : '' }}>
                    {{ $name }}
                  </label>
                </div>
                @endforeach
                <button class="btn btn-primary btn-block">Edit Roles</button>
              </form>
            </div>
          </div>
          <hr>
          <div class="box box-primary">
            <div class="box-header">
              <h1 class="box-title">Permisos</h1>
            </div>
            <div class="box-body">
              <form method="POST" action="{{ route('roles.update', $user) }}">
                @csrf @method('PUT')
                @foreach ($roles as $id => $name)
                <div class="checkbox">
                  <label>
                    <input name="roles" type="checkbox" value="{{ $id }}"
                      {{ $user->roles->contains($id) ? 'checked' : '' }}>
                    {{ $name }}
                  </label>
                </div>
                @endforeach
                <button class="btn btn-primary btn-block">Edit Roles</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  @endsection