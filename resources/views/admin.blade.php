@extends('layouts.app')

<style>
  .card-body th {
    padding: 5px 12px;
  }
</style>

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">User accounts</div>

        <div class="card-body">
          <table>
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>State</th>
                <th>Type</th>
                <th>Set up</th>
                <th>Remove</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($accounts as $account)
              <tr>
                <th>{{ $account->id }}</th>
                <th>{{ $account->name }}</th>
                <th>{{ $account->email }}</th>
                @if ($account->isEnabled)
                <th style="color: green;">Enabled</th>
                @else
                <th style="color: rgba(165, 40, 40, 0.741);">Disabled</th>
                @endif
                @if ($account->isAdmin)
                <th><span style="color: green;">Admin</span></th>
                @else
                <th><span style="color: rgba(124, 117, 117, 0.741);">User</span></th>
                @endif
                <th><a href="{{ route('edit', $account) }}">Edit</a></th>
                <th>
                  <form method="POST" action="{{ route('delete', $account) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                  </form>
                </th>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection