<div class="full-header">
  <div class="header-section">
    <h2><a class="unstyled-link" href="/">D&D Designs</a></h2>
  </div>
  <div class="header-section">
  </div>
  <nav class="header-section main-nav">
    <a class="button nav-button" href="/">
      HOME
    </a>
    <a class="button nav-button" href="/products">
      PRODUCTS
    </a>
    <a class="button nav-button" href="/about">
      ABOUT
    </a>
    @empty($user)
      <a class="button nav-button" href="/login">
        LOGIN
      </a>
    @endempty
    @isset($user)
      @if($user->isAdmin())
        <a class="button nav-button" href="/admin">
          ADMIN
        </a>
      @endif
      <a class="button nav-button" href="/orders">
        MY ORDERS
      </a>
      <a class="button nav-button" href="/logout">
        LOGOUT
      </a>
    @endisset
  </nav>
</div>