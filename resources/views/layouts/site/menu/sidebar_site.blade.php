<template>
    <b-menu class="box">
        <b-menu-list>
            <b-menu-item
                href="{{route('about')}}"
                label="@lang('page.sidebar.item_1')">
            </b-menu-item>
            <b-menu-item
                href="{{route('term')}}"
                label="@lang('page.sidebar.item_2')">
            </b-menu-item>
            <b-menu-item
                href="{{route('for_executors')}}"
                label="@lang('page.sidebar.item_3')">
            </b-menu-item>
            <b-menu-item
                href="{{route('for_customers')}}"
                label="@lang('page.sidebar.item_4')">
            </b-menu-item>
            <b-menu-item
                href="{{route('customer_service')}}"
                label="@lang('page.sidebar.item_5')">
            </b-menu-item>
            <b-menu-item
                href="{{route('car_brands')}}"
                label="@lang('page.sidebar.item_6')">
            </b-menu-item>
{{--            <b-menu-item--}}
{{--                href="{{route('blog_categories')}}"--}}
{{--                label="@lang('page.sidebar.item_7')">--}}
{{--            </b-menu-item>--}}
        </b-menu-list>
    </b-menu>
</template>
