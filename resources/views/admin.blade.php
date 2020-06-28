@extends('layouts.app')

<style>
  .card-body th {
    padding: 5px 10px;
  }
</style>

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card">
        <div class="card-header">User accounts</div>

        <div class="card-body">
          <table>
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>State</th>
                <th>Type</th>
                <th>Set up</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($accounts as $account)
              <tr>
                <th>{{ $account->id }}</th>
                <th>{{ $account->name }}</th>
                <th>{{ $account->email }}</th>
                <th>
                  @if ($account->isEnabled)
                  <span style="color: green;">Enabled</span>
                  @else
                  <span style="color: rgba(165, 40, 40, 0.741);">Disabled</span>
                  @endif
                </th>
                <th>
                  @if ($account->isAdmin)
                  <span style="color: green;">Admin</span>
                  @else
                  <span style="color: rgba(124, 117, 117, 0.741);">User</span>
                  @endif
                </th>
                <th><a href="{{ route('edit', $account) }}">Edit</a></th>
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