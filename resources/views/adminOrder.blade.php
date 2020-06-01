@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Order '.$order->number)

@section('header')

@endsection

@section('content')
  <div class="page-container">
    <h1>Order {{ $order->number }}</h1>
    <h2>Current Status</h2>
    <p>{{ $order->status->title }}</p>

    <h2>Contact Info</h2>
    <p>Name: {{ $order->first_name }} {{ $order->last_name }}</p>
    <p>Phone: {{ $order->phone }}</p>
    <p>Email: {{ $order->email }}</p>

    @foreach($order->orderItems as $orderItem)
      <h2>{{ $orderItem->item->title }}</h2>
      @foreach($orderItem->customizationResponses as $customizationResponse)
        @if($customizationResponse->customization->customization_type_id == 1)
          <p><b>{{ $customizationResponse->customization->title }}:</b> {{ $customizationResponse->text_response }}
        @elseif($customizationResponse->customization->customization_type_id == 2)
          <p>
            @if (!is_null($customizationResponse->option_id))
              <b>{{ $customizationResponse->customization->title }}:</b>
              {{ $customizationResponse->option->title }}
            @elseif (!is_null($customizationResponse->custom_response))
              <b>{{ $customizationResponse->customization->title }} (Custom Response):</b>
              {{ $customizationResponse->custom_response }}
            @endif
          </p>
        @endif
      @endforeach
    @endforeach

    <h2>Shipping Info</h2>
    <p><b>Address Line 1:</b> {{ $order->address->address_line_1 }}</p>
    <p><b>Address Line 2:</b> {{ $order->address->address_line_2 }}</p>
    <p><b>Address Line 3:</b> {{ $order->address->address_line_3 }}</p>
    <p><b>Address Line 4:</b> {{ $order->address->address_line_4 }}</p>
    <p><b>City:</b> {{ $order->address->city }}</p>
    <p><b>State:</b> {{ $order->address->state }}</p>
    <p><b>Zip:</b> {{ $order->address->zip }}</p>
    <p><b>Country:</b> {{ $order->address->country }}</p>

    <form
      method="POST"
      action="/admin/submitChangeStatus"
      class="pure-form pure-form-stacked"
      enctype="multipart/form-data"
    >
      @csrf
      <input type="hidden" name="orderId" value="{{ $order->id }}"></input>

      <label class="label" for="select">
        <h2>Change Order Status</h2>
      </label>
      <select
        id="select"
        class="pure-input"
        name="statusId"
        required
      >
        @foreach ($statuses as $status)
          <option
            value="{{ $status->id }}"
            @if ($status->id == $order->status->id)
              selected
            @endif
          >
            {{ $status->title }}
          </option>
        @endforeach
      </select>

      <input
        class="button button-dark outlined"
        type="submit"
        value="SAVE"
      />
    </form>
  </div>
@endsection
