@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.executor.packages')
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="hero-body">
                        <div class="box_account">
                            <div class="columns">
                                <div class="tile is-ancestor">
                                    <div class="column is-4 text-center">
                                        <article class="tile is-child box">
                                            <div class="content">
                                                <p class="title">{{$base->name}}</p>
                                                <hr>
                                                <p class="subtitle">@lang('package.limit_offers')</p>
                                                <h2 class="subtitle">{{$base->limit_offers}}
                                                    / @lang('package.months')</h2>
                                                <hr>
                                                <p class="subtitle">@lang('package.color_catalog')</p>
                                                <h2 class="subtitle">@lang('package.no')</h2>
                                                <hr>
                                                <p class="subtitle">@lang('package.connect_customer')</p>
                                                <h2 class="subtitle">@lang('package.no')</h2>
                                                <hr>
                                                <div class="content">
                                                    <p class="subtitle"><b>FREE</b></p>
                                                    @if(!check_premium(Auth::id()))
                                                        <a class="button is-dark-passive is-medium">@lang('package.default')</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="column is-4 text-center">
                                        <article class="tile is-child box premium">
                                            <div class="content">
                                                <p class="title">
                                                    {{$pro->name}}
                                                    <span class="icon has-text-success is-medium">
                                                        <i class="mdi mdi-professional-hexagon mdi-36px"></i>
                                                    </span>
                                                </p>
                                                <hr>
                                                <p class="subtitle">@lang('package.limit_offers')</p>
                                                <h2 class="subtitle">@lang('package.no_limit')</h2>
                                                <hr>
                                                <p class="subtitle">@lang('package.color_catalog')</p>
                                                <h2 class="subtitle">@lang('package.yes')</h2>
                                                <hr>
                                                <p class="subtitle">@lang('package.connect_customer')</p>
                                                <h2 class="subtitle">@lang('package.yes')</h2>
                                                <hr>
                                                <div class="content">
                                                    <p class="subtitle">
                                                        <b>{{$pro->price}}грн.</b> / <small>{{$pro->days}}
                                                            @lang('package.days')</small>
                                                    </p>
                                                    @if(check_premium(Auth::id()))
                                                        <a class="button is-dark-passive is-medium">@lang('package.default')</a>
                                                    @else
                                                        <a href="{{route('executor_buy_package', $pro->id)}}"
                                                           class="button is-dark is-medium">@lang('package.get')</a>
                                                        <p class="mt-5">
                                                            <input type="checkbox" checked disabled /> Я согласен с условиями <a href="{{route('public_offer')}}">Публичной оферты</a>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--todo убрать тестовые данные-->
                        <b-notification
                            type="is-warning"
                            role="alert">
                            <b>Тестовые номера карт</b>
                            <hr>
                            <p>4444555511116666 - Срок действия: любой - CVV2: любой - ответ Успешный</p>
                            <p>4444111155556666 - Срок действия: любой - CVV2: любой - ответ Отказ</p>
                        </b-notification>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
