@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.executor.orders')
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="box_account col-md-12">
                <executor-orders-profile
                    :executor="{{$executor}}"
                    :lang="{{$lang}}">
                </executor-orders-profile>
            </div>
        </div>
    </div>
@endsection
