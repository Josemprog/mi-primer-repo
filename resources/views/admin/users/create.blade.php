@extends('layouts.app')

@section('content')
<div class="row" style="padding: 10px">

  <div class="col-2">
    @auth
    @if (Auth::user()->admin or Auth::user()->main_admin)
    <div class="btn-group-vertical">
      <a class="btn btn-primary" href="{{ route('users.index') }}">Back to accounts</a>
      <a class="btn btn-primary" href="{{ route('products.index') }}">Manage products</a>
    </div>
    @endif
    @endauth
  </div>

  <div class="col-10">


    <div class="container">
      <div class=" justify-content-center">
        <div class="col-md-10 p-edit-2">

          <h1 class="text-primary">Creating Users</h1>
          <form method="POST" action=" {{ route('users.store')}} " class="form-group">
            @csrf

            <label class="text-info" for="name">Name</label>
            <input name="name" id="name" class="form-control" placeholder="Name ..." required>

            <label class="text-info" for="email">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email ..." required>

            <label class="text-info" for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="password ..." required>

            <br>

            <button type="submit" class="btn btn-info btn-lg btn-block">Create</button>

          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection