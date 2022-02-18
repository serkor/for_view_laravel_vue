{{--Settings LocateServiceProvider--}}

<div class="navbar-item has-dropdown is-hoverable">
    <a class="navbar-link">
        @lang('navigate.lang')
    </a>
    <div class="navbar-dropdown">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a rel="alternate" class="navbar-item" hreflang="{{ $localeCode }}"
               href="{{LaravelLocalization::getLocalizedURL($localeCode, NULL, [], TRUE) }}">
                {{ $properties['native'] }}
            </a>
        @endforeach
    </div>
</div>
