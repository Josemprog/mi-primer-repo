@extends('layouts.app')

@section('content')
<div class="row" style="padding: 10px">

  <div class="col-2">
    <div class="btn-group-vertical">
      <a class="btn btn-primary" href="{{ route('users.index') }}">Back to accounts</a>
    </div>
  </div>

  <div class="col-10">


    <div class="container">
      <div class=" justify-content-center">
        <div class="col-md-10">
          <h1 class="text-primary">Editing User <span style="color:rgb(39, 86, 161)">{{ $user->name }}</span></h1>
          <form method="POST" action="{{ route('users.update', $user) }}" class="form-group">
            @csrf
            @method('PATCH')

            <label class="text-info" for="id">Id</label>
            <p name="id" class="form-control" style="background: none">{{ $user->id }}</p>

            <label class="text-info" for="name">Name</label>
            <input style="border: rgba(122, 122, 122, 0.591) solid 1px" type="text" name="name" id="name"
              class="form-control" value="{{ $user->name }}">

            <label class="text-info" for="email">Email</label>
            <p name="email" class="form-control" style="background: none">{{ $user->email }}</p>

            <br>

            <select class="btn btn-warning btn-lg btn-block dropdown-toggle" name="select" id="select">

              @if ($user->enabled)
              <option value=1 selected>Enabled</option>
              <option value=0>Disabled</option>
              @else
              <option value=1>Enabled</option>
              <option value=0 selected>Disabled</option>
              @endif
            </select>

            <button type="submit" class="btn btn-info btn-lg btn-block">Edit User</button>

          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection