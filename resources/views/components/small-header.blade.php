<div class="small-header">
  <div class="header-section">
    <h2>
      <a class="unstyled-link" href="/">D&D Designs</a>
    </h2>
  </div>
  <div class="header-section menu-button-container">
    <button
      class="button menu-button"
      onclick="window.openDrawer()"
    >
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</div>
<div
  class="drawer-overlay"
  id="drawer-overlay"
  onclick="window.closeDrawer()"
  style="display: none;"
>
</div>
<div
  class="drawer"
  id="drawer"
  style="transform: translateX(280px);"
>
  <a href="/" class="menu-item">
    <span class="mdi mdi-home menu-item-icon"></span>
    Home
  </a>
  <a href="/products" class="menu-item">
    <span class="mdi mdi-basket menu-item-icon"></span>
    Products
  </a>
  <a href="/about" class="menu-item">
    <span class="mdi mdi-information menu-item-icon"></span>
    About Us
  </a>
  @empty($user)
    <a href="/login" class="menu-item">
      <span class="mdi mdi-login menu-item-icon"></span>
      Login
    </a>
  @endempty
  @isset($user)
    @if($user->isAdmin())
      <a href="/admin" class="menu-item">
        <span class="mdi mdi-account menu-item-icon"></span>
        Admin
      </a>
    @endif
    <a href="/orders" class="menu-item">
      <span class="mdi mdi-format-list-bulleted menu-item-icon"></span>
      Orders
    </a>
    <a href="/logout" class="menu-item">
      <span class="mdi mdi-logout menu-item-icon"></span>
      Logout
    </a>
  @endisset
</div>