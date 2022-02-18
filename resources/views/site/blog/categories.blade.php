@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.blog.categories')
                </p>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="hero-body">
            <div class="box_account box">
                <div class="columns">
                    <div class="column is-2">
                        @include('layouts.site.menu.sidebar_site')
                    </div>
                    <div class="column is-10">
                        <div class="columns">
                            @foreach($categories as $category)
                                <div class="column">
                                    <div class="box">
                                        <p class="title is-3">{{$category->name}}</p>
                                        <a href="{{route('blog_category', $category->id)}}"
                                           class="button is-dark">@lang('blog_category.more')</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
