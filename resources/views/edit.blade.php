@extends('layouts.app')

<style>
  .card-body th {
    padding: 5px 10px;
  }

  .card-body td {
    padding: 5px 10px;
  }

  input {
    border: none;
  }
</style>

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header">User accounts</div>
        <div class="card-body">
          <form method="POST" action=" {{ route('change', $user) }}">
            @method('PATCH')
            @csrf
            <table>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>State</th>
                  <th>Set up</th>
                  <th style="color: red;">Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $user->id }}</td>
                  <td><input name="name" id="name" value="{{ $user->name }}"></td>
                  <td>{{ $user->email }}</td>
                  @if ($user->isEnabled)
                  <td><span style="color: green;">Enabled</span></td>
                  @else
                  <td><span style="color :rgba(124, 117, 117, 0.741);">Disabled</span></td>
                  @endif
                  <td><button type="submit" class="btn btn-primary">Save</button></td>
                  <td>Remove</td>
                </tr>
              </tbody>
            </table>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection