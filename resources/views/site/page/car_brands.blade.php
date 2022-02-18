@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.car_brands.title')
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
                        <div class="box">
                            <div class="tags are-medium">
                                @foreach($marks as $mark)
                                    <span class="tag">{{$mark->name}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
