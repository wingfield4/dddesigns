@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Customize '.$item->title)

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/customize.css">
  <script src="/js/customize.js"></script>
  <script>
    window.item = @json($item);
    window.options = [];
    @foreach ($item->customizations as $customization)
      @foreach ($customization->options as $option)
        window.options.push(@json($option));
      @endforeach
    @endforeach
  </script>
@endsection

@section('content')
  <div class="page-container">
    <h1 class="title">{{ $item->title }} - Customize and Order</h1>
    <div class="caption">
      Please note: This is some info about how the process of ordering works - your request will be submitted
      and a quote will be sent to you shortly. Any prices displayed before the quote is receive are estimated prices
      and subject to change, blah blah blah
    </div>
    <div class="order-container">
      <div class="menu-container">
        <form
          class="pure-form pure-form-stacked"
          enctype="multipart/form-data"
          action="/orders/submit"
          method="POST"
          onsubmit="window.onSubmit()"
        >
          @csrf
          <input type="hidden" name="itemId" value="{{ $item->id }}">

          <!-- ITEM CUSTOMIZATION -->
          @if (count($item->customizations) > 0)
            <h2 class="section-header">Item Options</h2>
            <span class="section-subtitle">
              Customize this item. Please note that all prices are estimates and may change for the final quote depending on the chosen options.
            </span>
            <div class="divider"></div>
            @foreach ($item->customizations as $customization)
              <div class="customization-container">
                @if ($customization->customizationType->id == 1)
                  <div class="pure-u-1">
                    <label class="label" for="input-{{ $customization->id }}">{{ $customization->title }}</label>
                    <label class="caption" for="input-{{ $customization->id }}">{{ $customization->description }}</label>
                    <input
                      id="input-{{ $customization->id }}"
                      name="customization{{ $customization->id }}"
                      class="pure-input pure-u-1"
                      type="text"
                      maxlength="{{ $customization->free_text_max_length }}"
                      {{ $customization->required ? 'required' : '' }}
                    >
                  </div>
                @elseif ($customization->customizationType->id == 2)
                  <div class="pure-u-1">
                    <label class="label" for="select-{{ $customization->id }}">{{ $customization->title }}</label>
                    <label class="caption" for="select-{{ $customization->id }}">{{ $customization->description }}</label>
                    <select
                      id="select-{{ $customization->id }}"
                      class="pure-input"
                      onchange="window.onSelectChange({{ $customization->id }}, this)"
                      name="customization{{ $customization->id }}"
                      {{ $customization->required ? 'required' : '' }}
                    >
                      <option value="" disabled selected></option>
                      @foreach ($customization->options as $option)
                        {{-- <option value="{{ $customization->id }},{{ $option->id }},{{ $option->price }}"> --}}
                        <option value="{{ $option->id }}">
                          {{ $option->title }}
                          @if (!is_null($option->price))
                          (+${{$option->price}})
                          @endif
                        </option>
                      @endforeach
                      @if ($customization->allow_custom_option)
                        <option value="custom">
                          Custom
                        </option>
                      @endif
                    </select>

                    <div id="select-{{ $customization->id }}-custom-container" style="display: none;">
                      <label class="label" for="select-{{ $customization->id }}-custom">Custom</label>
                      <input
                        id="select-{{ $customization->id }}-custom"
                        name="customization{{ $customization->id }}Custom"
                        class="pure-input pure-u-1"
                        type="text"
                        maxlength="1000"
                      />
                    </div>
                  </div>
                @elseif ($customization->customizationType->id == 3)
                  <label class="label" for="input-{{ $customization->id }}">{{ $customization->title }}</label>
                  <label class="caption" for="input-{{ $customization->id }}">{{ $customization->description }}</label>
                  <input
                    name="customization{{ $customization->id }}"
                    id="input-{{ $customization->id }}"
                    class="pure-input pure-u-1"
                    type="file"
                    accept="image/*"
                    {{ $customization->required ? 'required' : '' }}
                  >
                @endif
              </div>
            @endforeach
          @endif

          <!-- CONTACT INFO -->
          <h2 class="section-header">Contact Information</h2>
          <span class="section-subtitle">
            This will allow us to contact you with a final quote for your customized order and provide updates as your order is processed and shipped.
          </span>
          <div class="divider"></div>
          <div class="pure-g">
            <div class="pure-u-1 pure-u-sm-1-2">
              <label class="label" for="input-first-name">First Name</label>
              <input
                id="input-first-name"
                name="firstName"
                class="pure-input pure-u-23-24"
                type="text"
                maxlength="100"
                required
                @isset($user)
                  value="{{ $user->first_name }}"
                @endisset
              >
            </div>
            <div class="pure-u-1 pure-u-sm-1-2">
              <label class="label" for="input-last-name">Last Name</label>
              <input
                id="input-last-name"
                name="lastName"
                class="pure-input pure-u-23-24"
                type="text"
                maxlength="100"
                required
                @isset($user)
                  value="{{ $user->last_name }}"
                @endisset
              >
            </div>
            <div class="pure-u-1">
              <label class="label" for="input-email">Email Address</label>
              <input
                id="input-email"
                name="email"
                class="pure-input pure-u-1"
                type="text"
                maxlength="100"
                required
                @isset($user)
                  value="{{ $user->email }}"
                  readonly
                @endisset
              >
            </div>
            <div class="pure-u-1 pure-u-sm-1-2">
              <label class="label" for="input-phone">Phone Number</label>
              <input
                id="input-phone"
                name="phone"
                class="pure-input pure-u-23-24"
                type="tel"
                maxlength="30"
              >
            </div>
          </div>

          <!-- SHIPPING INFO FIELDS -->
          <h2 class="section-header">Shipping Information</h2>
          <span class="section-subtitle">
            Please provide the address we can ship this order to.
          </span>
          <div class="divider"></div>
          <div class="pure-g">
            <div class="pure-u-1">
              <label class="label" for="input-address-line-1">Address Line 1</label>
              <input
                id="input-addres-line-1"
                name="addressLine1"
                class="pure-input pure-u-1"
                type="text"
                maxlength="255"
                required
              >
            </div>
            <div class="pure-u-1">
              <label class="label" for="input-address-line-2">Address Line 2</label>
              <input
                id="input-addres-line-2"
                name="addressLine2"
                class="pure-input pure-u-1"
                type="text"
                maxlength="255"
              >
            </div>
            <div class="pure-u-1">
              <label class="label" for="input-address-line-3">Address Line 3</label>
              <input
                id="input-addres-line-3"
                name="addressLine3"
                class="pure-input pure-u-1"
                type="text"
                maxlength="255"
              >
            </div>
            <div class="pure-u-1">
              <label class="label" for="input-address-line-4">Address Line 4</label>
              <input
                id="input-addres-line-4"
                name="addressLine4"
                class="pure-input pure-u-1"
                type="text"
                maxlength="255"
              >
            </div>
            
            <div class="pure-u-1 pure-u-sm-1-3">
              <label class="label" for="input-city">City</label>
              <input
                id="input-city"
                name="city"
                class="pure-input pure-u-23-24"
                type="text"
                maxlength="100"
                required
              >
            </div>
            <div class="pure-u-1 pure-u-sm-1-3">
              <label class="label" for="input-state">State</label>
              <input
                id="input-state"
                name="state"
                class="pure-input pure-u-23-24"
                type="text"
                maxlength="100"
                required
              >
            </div>
            <div class="pure-u-1 pure-u-sm-1-3">
              <label class="label" for="input-zip">ZIP</label>
              <input
                id="input-zip"
                name="zip"
                class="pure-input pure-u-23-24"
                type="text"
                maxlength="100"
                required
              >
            </div>
            <div class="pure-u-1 pure-u-sm-1-3">
              <label class="label" for="input-country">Country</label>
              <input
                id="input-country"
                name="country"
                class="pure-input pure-u-23-24"
                type="text"
                maxlength="100"
                required
              >
            </div>
          </div>

          <div class="submit-container">
            <input
              id="submit"
              type="submit"
              class="button button-dark outlined"
              @if ($item->item_type_id == 1)
                value="SUBMIT FOR QUOTE"
              @else
                value="CONTINUE TO PAYMENT"
              @endif
            >
          </div>
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
        <div class="receipt-item-container">
          <div class="receipt-item-cell label">
            Base {{ $item->title }}
          </div>
          <div class="receipt-item-cell">
            ${{ $item->price }}
          </div>
        </div>
        @foreach ($item->customizations as $customization)
          @if ($customization->customizationType->id != 2)
            @continue
          @endif
          <div class="receipt-item-container">
            <div class="receipt-item-cell">
              <span class="label">
                {{ $customization->title }}: 
              </span>
              <span id="option-title-{{ $customization->id }}">
              </span>
            </div>
            <div id="price-{{ $customization->id }}" class="receipt-item-cell">
              $0.00
            </div>
          </div>
        @endforeach
        <div class="receipt-spacer"></div>
        <div class="receipt-bottom-item-container">
          <div class="receipt-item-cell label">
            ESTIMATED TOTAL
          </div>
          <div id="total-price" class="receipt-item-cell label">
            ${{ $item->price }}
          </div>
        </div>
      </div>
    </div>
    <div class="loading-overlay loading-overlay-hidden" id="loading-overlay" style="display: none;">
      <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
      </div>
      <h2>Thank you!</h2>
      <p>We are submitting your customized order.</p>
    </div>
  </div>
@endsection
