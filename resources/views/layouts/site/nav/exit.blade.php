<hr class="navbar-divider">
<a class="navbar-item"
   href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <strong> @lang('auth.logout')</strong></a>
<form id="logout-form" action="{{ route('logout') }}" method="POST"
      style="display: none;">
    @csrf
</form>
