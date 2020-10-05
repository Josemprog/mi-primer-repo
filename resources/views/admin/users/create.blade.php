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
      <div class=" justify-content-center">
        <div class="col-md-10 p-edit-2">

          <h1 class="text-dark">Creating Users</h1>
          <form method="POST" action=" {{ route('users.store')}} " class="form-group">
            @csrf

            <label class="text-muted" for="name">Name</label>
            <input name="name" id="name" class="form-control" placeholder="Name ...">
            {!! $errors->first('name', '<small class="alert alert-danger">:message</small><br>') !!}

            <label class="text-muted" for="email">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email ...">
            {!! $errors->first('email', '<small class="alert alert-danger">:message</small><br>') !!}

            <label class="text-muted" for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="password ...">
            {!! $errors->first('password', '<small class="alert alert-danger">:message</small><br>') !!}

            <br>

            <button type="submit" class="btn btn-dark btn-lg btn-block">Create</button>

          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection