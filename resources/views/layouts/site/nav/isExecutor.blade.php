<div class="navbar-dropdown">
    <a class="navbar-item"
       href="{{ route('executor_profile') }}">@lang('navigate.executor.profile')</a>
    <a class="navbar-item"
       href="{{ route('executor_payments') }}">@lang('navigate.executor.payments')</a>
    <a class="navbar-item"
       href="{{ route('executor_packages') }}">@lang('navigate.executor.packages')</a>
    <a class="navbar-item"
       href="{{ route('executor_reviews') }}">@lang('navigate.executor.reviews')</a>
    <a class="navbar-item"
       href="{{ route('executor_offer_templates') }}">@lang('navigate.executor.offer_templates')</a>
    <a class="navbar-item"
       href="{{ route('catalog') }}">@lang('navigate.catalog')</a>
{{--    <a class="navbar-item"--}}
{{--       href="{{ route('executor_calendar') }}">@lang('navigate.executor.calendar')</a>--}}
    <a class="navbar-item"
       href="{{ route('executor_help') }}">@lang('navigate.executor.help')</a>
    <a class="navbar-item"
       href="{{ route('executor_settings') }}">@lang('navigate.executor.settings')</a>

    @include('layouts.site.nav.exit')
</div>
