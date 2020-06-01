<a href="/admin/order/{{ $order->number }}" class="order-link">
  <div class="order-card-container">
    <p>{{ $order->first_name }} {{ $order->last_name }}</p>
    <span>--</span><br />
    <span>Order placed at {{ $order->created_at }}</span>
  </div>
</a>