@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Order')

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/fullOrder.css">
@endsection

@section('content')
  <div class="page-container">
    <div class="order-container">
      <div class="menu-container">
        @if($order->status_id == 8)
          <h1>Almost There!</h1>
          Just review your order, choose your payment method, and submit!
        @endif

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
            @elseif($customizationResponse->customization->customization_type_id == 3)
              <p>
                <b>{{ $customizationResponse->customization->title }}:</b> 
                <a href="/admin/file/{{ $customizationResponse->image->full_path }}" target="_blank">VIEW UPLOADED IMAGE</a>
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

        <h2>Total Price</h2>
        ${{ $order->totalPrice() }}
        
        <br /><br />
        <form
          class="pure-form pure-form-stacked"
          enctype="multipart/form-data"
          action="/orders/submitPayment"
          method="POST"
          onsubmit="window.onSubmit()"
        >
          @csrf
          <input type="hidden" value="{{ $order->id }}" name="orderId" />
          <input type="hidden" value="{{ $order->token }}" name="token" />
          <input
            class="button button-dark outlined"
            type="submit"
            value="SUBMIT ORDER"
          />
        </form>
      </div>
      <div class="receipt-container">
        <div class="receipt-center-divider"></div>
        <div class="receipt-item-container">
          <div class="receipt-item-cell label">
            Option
          </div>
          <div class="receipt-item-cell label">
            Price
          </div>
        </div>
        @foreach($order->orderItems as $orderItem)
          <div class="receipt-item-container">
            <div class="receipt-item-cell label">
              {{ $orderItem->item->title }}
            </div>
            <div class="receipt-item-cell">
              ${{ $orderItem->item->price }}
            </div>
          </div>
          @foreach ($orderItem->customizationResponses as $customizationResponse)
            @if ($customizationResponse->customization->customizationType->id != 2)
              @continue
            @endif
            <div class="receipt-item-container">
              <div class="receipt-item-cell">
                <span class="label">
                  {{ $customizationResponse->customization->title }}: 
                </span>
                <span id="option-title-{{ $customization->id }}">
                </span>
              </div>
              <div id="price-{{ $customization->id }}" class="receipt-item-cell">
                $0.00
              </div>
            </div>
          @endforeach
        @endforeach
        <div class="receipt-spacer"></div>
        <div class="receipt-bottom-item-container">
          <div class="receipt-item-cell label">
            TOTAL
          </div>
          <div id="total-price" class="receipt-item-cell label">
            ${{ $order->totalPrice() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
