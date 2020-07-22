@extends('layouts.app')

<style>
  .card-body th {
    padding: 5px 10px;
  }

  .card-body td {
    padding: 5px 10px;
  }

  input {
    /* border: none; */
    width: 160px;
  }
</style>

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header h4">Editing user account {{ $user->name }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('update', $user) }}">
            @method('PATCH')
            @csrf
            <table>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>State</th>
                  <th>Set up</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $user->id }}</td>
                  <td><input name="name" id="name" value="{{ $user->name }}" required></td>
                  <td>{{ $user->email }}</td>
                  <td>
                    <select name="select" id="select">
                      <option value=1>Enabled</option>
                      <option value=0>Disabled</option>
                    </select>
                  </td>
                  <td><button class="btn btn-primary">Save</button></td>
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