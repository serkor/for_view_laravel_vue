@extends('layouts.site.app')

@section('content')

    <section class="hero is-medium section is-warning text-center">
        <h1 class="title mb-3 is-1">@lang('home.block_1_text_1')</h1>
        <h2 class="subtitle mt-3 is-3">@lang('home.block_1_text_2')</h2>
        <p>
            @if(Auth::check())
                @if(Auth::user()->isCustomer())
                    <a href="{{route('customer_bids')}}" class="button is-medium is-dark">
                        @lang('home.block_1_button_1')</a>
                @endif
                @if(Auth::user()->isExecutor())
                    <a href="{{route('executor_bids')}}" class="button is-medium is-dark">
                        @lang('home.block_1_button_1')</a>
                @endif
            @else
                <a href="{{route('register')}}" class="button is-medium is-dark">
                    @lang('home.block_1_button_1')</a>
            @endif
        </p>
    </section>

    <section class="section text-center shadow-sm">
        <h3 class="title">@lang('home.block_2_text_1')</h3>
        <div class="columns">
            <div class="column box m-5">
                <span class="title mdi mdi-check mdi-36px"></span>
                <h3 class="subtitle mt-3">@lang('home.block_2_text_2')</h3>
            </div>
            <div class="column box m-5">
                <span class="title mdi mdi-check mdi-36px"></span>
                <h3 class="subtitle mt-3">@lang('home.block_2_text_3')</h3>
            </div>
            <div class="column box m-5">
                <span class="title mdi mdi-check mdi-36px"></span>
                <h3 class="subtitle mt-3">@lang('home.block_2_text_4')</h3>
            </div>
            <div class="column box m-5">
                <span class="title mdi mdi-check mdi-36px"></span>
                <h3 class="subtitle mt-3">@lang('home.block_2_text_5')</h3>
            </div>
        </div>
    </section>

    <section class="section text-center hero is-light shadow-sm">
        <h3 class="title">@lang('home.block_3_text_1')</h3>
        <div class="columns">
            <div class="column box m-5">
                <span class="title">1</span>
                <h3 class="subtitle mt-3">@lang('home.block_3_text_2')</h3>
            </div>
            <div class="column box m-5">
                <span class="title">2</span>
                <h3 class="subtitle mt-3">@lang('home.block_3_text_3')</h3>
            </div>
            <div class="column box m-5">
                <span class="title">3</span>
                <h3 class="subtitle mt-3">@lang('home.block_3_text_4')</h3>
            </div>
            <div class="column box m-5">
                <span class="title">4</span>
                <h3 class="subtitle mt-3">@lang('home.block_3_text_5')</h3>
            </div>
        </div>
        <p>
            @if(Auth::check())
                @if(Auth::user()->isCustomer())
                    <a href="{{route('customer_bids')}}" class="button is-warning is-medium">
                        @lang('home.block_3_button_1')
                    </a>
                @endif
                @if(Auth::user()->isExecutor())
                    <a href="{{route('executor_bids')}}" class="button is-warning is-medium">
                        @lang('home.block_3_button_1')
                    </a>
                @endif
            @else
                <a href="{{route('register')}}" class="button is-warning is-medium">
                    @lang('home.block_3_button_1')
                </a>
            @endif
        </p>
    </section>

    <section class="section text-center shadow-sm">
        <h3 class="title">@lang('home.block_4_text_1')</h3>
        <div class="columns">
            <div class="column box m-5">
                <h4 class="title mt-3">@lang('home.block_4_text_2')</h4>
                <h4 class="subtitle mt-3 mb-3">@lang('home.block_4_text_3')</h4>
                <hr>
                @if(Auth::check())
                    <a href="{{route('customer_profile')}}" class="button is-warning">
                        @lang('home.block_4_button_1')</a>
                @else
                    <a href="{{route('register')}}" class="button is-warning">
                        @lang('home.block_4_button_2')</a>
                @endif
            </div>
            <div class="column box m-5">
                <h4 class="title mt-3">@lang('home.block_4_text_4')</h4>
                <h4 class="subtitle mt-3 mb-3">@lang('home.block_4_text_5')</h4>
                <hr>
                @if(Auth::check())
                    <a href="{{route('executor_profile')}}" class="button is-warning">
                        @lang('home.block_4_button_1')</a>
                @else
                    <a href="{{route('register')}}" class="button is-warning">
                        @lang('home.block_4_button_2')</a>
                @endif
            </div>
        </div>
    </section>

    <section class="section text-center text-left hero is-light shadow-sm">
        <h3 class="title">@lang('home.block_5_text_1')</h3>
        <site-review-home
            :reviews="{{$reviews }}"
            :lang="{{$lang}}">
        </site-review-home>
    </section>

@endsection
