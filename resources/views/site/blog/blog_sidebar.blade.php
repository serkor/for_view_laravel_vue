<template>
    <b-menu class="box">
        <b-menu-list label="@lang('blog_category.title')">
            @foreach($blog_categories as $blog_category)
                <b-menu-item
                    href="{{route('blog_category', $blog_category->id)}}"
                    label="{{$blog_category->name}}">
                </b-menu-item>
            @endforeach
        </b-menu-list>
    </b-menu>
</template>
