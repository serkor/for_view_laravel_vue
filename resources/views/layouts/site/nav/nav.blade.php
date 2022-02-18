<nav class="navbar shadow-sm" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <strong>{{env('APP_NAME')}}</strong>
        </a>
        <a role="button" class="navbar-burger" aria-label="menu"
           aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            @guest
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-light" href="{{route('about')}}">
                            @lang('navigate.about')
                        </a>
                        <a class="button is-light" href="{{route('catalog')}}">
                            @lang('navigate.search_sto')
                        </a>
                    </div>
                </div>
            @else
                @if(Auth::check())
                    @if(Auth::user()->isCustomer())
                        <div class="navbar-item">
                            <div class="buttons">
                                <a class="button is-dark is-outlined"
                                   href="{{route('customer_bids')}}">
                                    <span class="mdi mdi-gavel"></span>&nbsp;
                                    @lang('navigate.customer.bids')
                                </a>
                                <a class="button is-dark is-outlined"
                                   href="{{route('customer_orders')}}">
                                    <span class="mdi mdi-check-all"></span>&nbsp;
                                    @lang('navigate.customer.orders')
                                </a>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->isExecutor())
                        <div class="navbar-item">
                            <div class="buttons">
                                <a class="button is-dark is-outlined"
                                   href="{{route('executor_bids')}}">
                                    <span class="mdi mdi-gavel"></span>&nbsp;
                                    @lang('navigate.executor.bids')
                                </a>
                                <a class="button is-dark is-outlined"
                                   href="{{route('executor_orders')}}">
                                    <span class="mdi mdi-check-all"></span>&nbsp;
                                    @lang('navigate.executor.orders')
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
            @endguest
        </div>
        <div class="navbar-end">
            @guest
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-light" href="{{ route('login') }}">
                            @lang('auth.login_title')
                        </a>
                        <a class="button is-dark" href="{{ route('register') }}">
                            <strong>@lang('auth.register_title')</strong>
                        </a>
                    </div>
                </div>
            @else
                @if(Auth::check())

                    <a class="navbar-item" href="{{route('notifications')}}">
                        <site-notifications-count></site-notifications-count>
                    </a>

                    <div class="navbar-item">
                        <div class="buttons">
                            @if(Auth::user()->isExecutor())
                                @if(check_premium(Auth::id()))
                                    <a class="navbar-item is-success" type="buttons"
                                       href="{{ route('executor_packages') }}">
                                        <b-icon
                                            pack="mdi"
                                            type="is-success"
                                            size="is-medium"
                                            icon="professional-hexagon">
                                        </b-icon>
                                    </a>
                                @else
                                    <a class="navbar-item is-warning" type="buttons"
                                       href="{{ route('executor_packages') }}">
                                        <b-icon
                                            pack="mdi"
                                            type="is-warning"
                                            size="is-medium"
                                            icon="alert-decagram">
                                        </b-icon>
                                    </a>
                                @endif
                            @endif

                        </div>
                    </div>

                    <div class="navbar-item has-dropdown is-hoverable">

                        <span class="navbar-link">
                             @lang('navigate.account_title')
                        </span>

                        @if(Auth::user()->isAdmin())
                            @include('layouts.site.nav.isAdmin')
                        @endif

                        @if(Auth::user()->isCustomer())
                            @include('layouts.site.nav.isCustomer')
                        @endif

                        @if(Auth::user()->isExecutor())
                            @include('layouts.site.nav.isExecutor')
                        @endif

                    </div>
                @endif
            @endguest
        </div>
        @include('layouts.site.language')
    </div>
</nav>
