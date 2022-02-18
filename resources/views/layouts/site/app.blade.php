<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    @if(Auth::check())
        <span class="user_type badge badge-warning">
        Я сейчас - {{Auth::user()->nameRole()}}
    </span>
    @endif

    @include('layouts.site.nav.nav')

    <main>
        @include('layouts.site.info')

        @yield('content')
    </main>
</div>

<!-- Footer -->
<footer class="footer page-footer font-small mdb-color pt-4">

    <!-- Footer Links -->
    <div class="has-text-centered container text-center text-md-left">

        <!-- Footer links -->
        <div class="row text-center text-md-left mt-3 pb-3">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">@lang('page.footer.company')</h6>
                <p>@lang('page.footer.company_text')</p>
            </div>
            <!-- Grid column -->

            <hr class="w-100 clearfix d-md-none">

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">@lang('page.footer.info_text_1')</h6>
                <p>
                    <a href="{{route('about')}}">@lang('page.about.title')</a>
                </p>
                <p>
                    <a href="{{route('for_executors')}}">@lang('page.for_executors.title')</a>
                </p>
                <p>
                    <a href="{{route('for_customers')}}">@lang('page.for_customers.title')</a>
                </p>
                <p>
                    <a href="{{route('car_brands')}}">@lang('page.car_brands.title')</a>
                </p>
                <p>
                    <a href="{{route('customer_service')}}">@lang('page.customer_service.title')</a>
                </p>
{{--                <p>--}}
{{--                    <a href="{{route('blog_categories')}}">@lang('page.blog.title')</a>--}}
                </p>
                <p>
                    <a href="{{route('term')}}">@lang('page.term.title')</a>
                </p>
            </div>
            <!-- Grid column -->

            <hr class="w-100 clearfix d-md-none">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">@lang('page.footer.info_text_2')</h6>
                <p>
                    <a href="{{route('contacts')}}">@lang('page.contacts.title')</a>
                </p>
                <p>
                    <a href="{{route('investors')}}"> @lang('page.investors.title')</a>
                </p>
                <p>
                    <a href="{{route('vacancies')}}">@lang('page.vacancies.title')</a>
                </p>
                <p>
                    <a href="{{route('advertising')}}">@lang('page.advertising.title')</a>
                </p>
                <p>
                    <a href="{{route('partners')}}">@lang('page.partners.title')</a>
                </p>
                <p>
                    <a href="{{route('public_offer')}}">@lang('page.public_offer.title')</a>
                </p>
                <p>
                    <a href="{{route('privacy_policy')}}">@lang('page.privacy_policy.title')</a>
                </p>

            </div>

            <!-- Grid column -->
            <hr class="w-100 clearfix d-md-none">

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">@lang('page.footer.info_text_3')</h6>
                <p>
                    <i class="fas fa-home mr-3"></i> Украина, г.Черкассы</p>
                <p>
                    <i class="fas fa-envelope mr-3"></i> info@birjasto.com</p>
                <p>
                    <i class="fas fa-phone mr-3"></i> +3 234 567 88</p>
                <p>
                    <i class="fas fa-phone mr-3"></i> +3 234 567 89</p>
            </div>
            <!-- Grid column -->

        </div>
        <!-- Footer links -->

        <hr>

        <!-- Grid row -->
        <div class="row d-flex align-items-center">
            <!-- Grid column -->
            <div class="col-md-7 col-lg-8">
                <!--Copyright-->
                <p class="text-center text-md-left">
                    <a target="_blank" href="https://t.me/needplex">
                        NEEDPLEX
                    </a>
                </p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-5 col-lg-4 ml-lg-0">

                <!-- Social buttons -->
                <div class="text-center text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                            <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                <i class="fab fa-google-plus-g"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

        <p>Админ: admin@admin.admin | Исполнитель: executor@executor.executor | Заказчик: customer@customer.customer | Пароль: 123456789</p>

    </div>
    <!-- Footer Links -->

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Get all "navbar-burger" elements
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            // Check if there are any navbar burgers
            if ($navbarBurgers.length > 0) {

                // Add a click event on each of them
                $navbarBurgers.forEach(el => {
                    el.addEventListener('click', () => {

                        // Get the target from the "data-target" attribute
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);

                        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');

                    });
                });
            }

        });
    </script>

@yield('js')

@yield('modal')

</body>
</html>
