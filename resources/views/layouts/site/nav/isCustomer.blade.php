<div class="navbar-dropdown">
    <a class="navbar-item"
       href="{{ route('customer_profile') }}">@lang('navigate.customer.profile')</a>
    <a class="navbar-item"
       href="{{ route('catalog') }}">@lang('navigate.catalog')</a>
    <a class="navbar-item"
       href="{{ route('customer-cars.index') }}">@lang('navigate.customer.cars')</a>
    <a class="navbar-item"
       href="{{ route('customer_favorites') }}">@lang('navigate.customer.favorites')</a>
    <a class="navbar-item"
       href="{{ route('customer_help') }}">@lang('navigate.customer.help')</a>
    <a class="navbar-item"
       href="{{ route('customer_settings') }}">@lang('navigate.customer.settings')</a>

    @include('layouts.site.nav.exit')
</div>
