@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Admin - Orders')

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/adminOrders.css">
@endsection

@section('content')
  <div class="page-container">
    <h1>Orders</h1>

    <form
      class="pure-form"
      enctype="multipart/form-data"
      action="/admin/applyOrderFilters"
      method="POST"
    >
      @csrf
      <legend>Order Filters</legend>

      <div><label for="status-select">Order Status</label></div>
      <select
        id="status-select"
        class="pure-input"
        name="status"
      >
        <option
          value="active"
          @if ($status == 'active')
            selected
          @endif
        >
          Active
        </option>
        <option
          value="closed"
          @if ($status == 'closed')
            selected
          @endif
        >
          Closed
        </option>
        <option
          value="all"
          @if ($status == 'all')
            selected
          @endif
        >
          All
        </option>
      </select>

      <input
        type="submit"
        class="button button-dark outlined"
        value="APPLY"
      />
    </form>
    <br />

    @if (count($orders) > 0)
      <table class="pure-table pure-table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Item</th>
            <th>Status</th>
            <th>Ordered At</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
            <tr>
              <td>
                <a href="/admin/order/{{ $order->number }}">{{ $order->number }}</a>
              </td>
              <td>{{ $order->first_name }} {{ $order->last_name }}</td>
              <td>
                @foreach($order->items as $item)
                  {{ $item->title }}<br />
                @endforeach
              </td>
              <td>{{ $order->status->title }}</td>
              <td>{{ date_format($order->created_at, 'm-d-Y H:i') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <h2>No Orders Found!</h2>
    @endif
  </div>
@endsection
