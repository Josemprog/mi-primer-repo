@extends('layouts.app')

@section('content')
<div class="main-container">

  <div class="container-filter">
    <div class="container">
      {{-- Administrator menu --}}
      @auth
      {{-- buttons --}}
      <div>
        <a class="btn btn-dark btn-lg mb-2" href="{{ route('orders.index') }}">Back to Orders</a>
      </div>
      @endauth
    </div>

  </div>

  <div class="container-products">

    <div class="container">
      <h1 class="text-dark d-flex justify-content-center h-big">Orders Details</h1>


      <div class="container d-flex flex-column justify-content-center">

        <table class="table table-striped p-edit-2 w-auto">
          <thead>
            <tr class="text-muted">
              <th>Request Id</th>
              <th>Status</th>
              <th>Message</th>
              <th>Locale</th>
              <th>Amount</th>
              <th>Type of currency</th>
              <th>Retry payment</th>
            </tr>
          </thead>
          <tbody>
            <tr scope="row">
              <td>{{ $payment['requestId'] }}</td>
              <td>{{ $payment['status']['status'] }}</td>
              <td>{{ $payment['status']['message'] }}</td>
              <td>{{ $payment['request']['locale'] }}</td>
              <td>{{ number_format($payment['request']['payment']['amount']['total']) }}</td>
              <td>{{ $payment['request']['payment']['amount']['currency'] }}</td>
              <td>
                <form method="POST" action="{{ route('orders.retry', ['order' => $order]) }}">
                  @csrf
                  <button class="btn btn-success">Retry</button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection