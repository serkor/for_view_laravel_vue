@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.catalog.title')
                </p>
            </div>
        </div>
    </section>
    <div class="container">
        @if($user->isCustomer())
            <site-catalog-for-customer
                :customer="{{$user}}"
                :lang="{{$lang}}"
                :lang_bid="{{$lang_bid}}"
                :cars="{{$cars}}"
                :cities="{{$cities}}"
                :categories="{{$categories}}"
                :marks="{{$marks}}"
                :mark_models="{{$mark_models}}"
                :transmissions="{{$transmissions}}"
                :years="{{$years}}">
            </site-catalog-for-customer>
        @else
            <site-catalog-for-executor
                :cities="{{$cities}}"
                :categories="{{$categories}}"
                :lang="{{$lang}}">
            </site-catalog-for-executor>
        @endif
    </div>
@endsection
