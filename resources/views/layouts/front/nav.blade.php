<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <ul class="list-unstyled mb-0 py-3 pt-md-1">
        <li class="mb-1">
            <a class="btn d-inline-flex align-items-center rounded collapsed" aria-current="page" href="{{ route('dashboardIndex') }}">
                Панель
            </a>
        </li>


        <li class="mb-1">
            <a class="btn d-inline-flex align-items-center rounded collapsed"  href="{{route('bids.index')}}">
                @lang('bid.title')
            </a>
        </li>

        <li class="mb-1">
            <a class="btn d-inline-flex align-items-center rounded collapsed"  href="{{route('admin_payments')}}">
                @lang('payment.title')
            </a>
        </li>

        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#helpers-catalog" aria-expanded="false">
                Каталог <span class="mdi mdi-plus"></span>
                <span data-feather="plus"></span>
            </button>
            <div class="collapse" id="helpers-catalog">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_categories')}}">
                            <span data-feather="file"></span>
                            @lang('category.title')
                        </a>
                        <a class="nav-link" href="{{route('marks.index')}}">
                            <span data-feather="file"></span>
                            @lang('auto.mark.title')
                        </a>
                        <a class="nav-link" href="{{route('mark-models.index')}}">
                            <span data-feather="file"></span>
                            @lang('auto.model.title')
                        </a>
                        <a class="nav-link" href="{{route('years.index')}}">
                            <span data-feather="file"></span>
                            @lang('auto.year.title')
                        </a>
                        <a class="nav-link" href="{{route('transmissions.index')}}">
                            <span data-feather="file"></span>
                            @lang('auto.transmission.title')
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#helpers-users" aria-expanded="false">
                Пользователи <span class="mdi mdi-plus"></span>
                <span data-feather="plus"></span>
            </button>
            <div class="collapse" id="helpers-users">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_users')}}">
                            <span data-feather="file"></span>
                            @lang('user.admin.title')
                        </a>
                        <a class="nav-link" href="{{route('customer_users')}}">
                            <span data-feather="file"></span>
                            @lang('customer.title')
                        </a>
                        <a class="nav-link" href="{{route('executor_users')}}">
                            <span data-feather="file"></span>
                            @lang('executor.title')
                        </a>
                        <a class="nav-link" href="{{route('roles.index')}}">
                            <span data-feather="file"></span>
                            @lang('role.title')
                        </a>
                        <a class="nav-link" href="{{route('admin_reviews')}}">
                            <span data-feather="file"></span>
                            @lang('review.title')
                        </a>
                        <a class="nav-link" href="{{route('admin_cars')}}">
                            <span data-feather="file"></span>
                            @lang('car.title')
                        </a>
                        <a class="nav-link" href="{{route('offer-templates.index')}}">
                            <span data-feather="file"></span>
                            @lang('offer_template.title_admin')
                        </a>
                    </li>
                </ul>
            </div>
        </li>

{{--        <li class="mb-1">--}}
{{--            <button class="btn d-inline-flex align-items-center rounded collapsed" data-bs-toggle="collapse"--}}
{{--                    data-bs-target="#helpers-blog" aria-expanded="false">--}}
{{--                Блог <span class="mdi mdi-plus"></span>--}}
{{--                <span data-feather="plus"></span>--}}
{{--            </button>--}}
{{--            <div class="collapse" id="helpers-blog">--}}
{{--                <ul class="nav flex-column">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{route('admin_blog_categories')}}">--}}
{{--                            <span data-feather="file"></span>--}}
{{--                            @lang('blog_category.title')--}}
{{--                        </a>--}}
{{--                        <a class="nav-link" href="{{route('admin_blog_articles')}}">--}}
{{--                            <span data-feather="file"></span>--}}
{{--                            @lang('blog_article.title')--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}

        <li class="mb-1">
            <button class="btn d-inline-flex align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#helpers-settings" aria-expanded="false">
                Настройки <span class="mdi mdi-plus"></span>
                <span data-feather="plus"></span>
            </button>
            <div class="collapse" id="helpers-settings">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_packages')}}">
                            <span data-feather="file"></span>
                            @lang('package.title')
                        </a>
                        <a class="nav-link" href="{{route('payment_types.index')}}">
                            <span data-feather="file"></span>
                            @lang('payment_type.title')
                        </a>
                        <a class="nav-link" href="{{route('additional_services.index')}}">
                            <span data-feather="file"></span>
                            @lang('additional_service.title')
                        </a>
                        <a class="nav-link" href="{{route('languages.index')}}">
                            <span data-feather="file"></span>
                            @lang('language.title')
                        </a>
                        <a class="nav-link" href="{{route('files.index')}}">
                            <span data-feather="file"></span>
                            @lang('file.title')
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="mb-1">
            <a class="btn d-inline-flex align-items-center rounded collapsed"  href="{{route('appeals.index')}}">
                @lang('appeal.title')
            </a>
        </li>
    </ul>
</nav>


