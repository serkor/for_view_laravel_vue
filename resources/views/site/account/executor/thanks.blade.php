@extends('layouts.site.app')


@section('content')
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.thanks.title')
                </p>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="hero-body">
            <div class="box_account">
                <div class="columns">
                    <div class="column">
                        @lang('page.thanks.pay_success')
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <a class="button is-dark" href="{{route('executor_payments')}}">
                            @lang('page.thanks.your_payments')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
