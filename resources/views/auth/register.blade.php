@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('auth.register_title')
                </p>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="hero-body">

            <div class="subtitle text-center">
                @lang('auth.register_subtitle')
            </div>

            <div class="columns">
                <div class="column is-3"></div>
                <div class="column box is-6">
                    <all-register :lang="{{$lang}}" :cities="{{$cities}}"></all-register>
                </div>
                <div class="column is-3"></div>
            </div>
        </div>
    </div>
@endsection
