@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.customer.cars')
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <customer-add-car-profile
                    :customer="{{$customer}}"
                    :marks="{{$marks}}"
                    :transmissions="{{$transmissions}}"
                    :years="{{$years}}"
                    :lang="{{$lang}}"
                    :mark_models="{{$mark_models}}">
                </customer-add-car-profile>
                <hr>
                <div class="card">
                    <customer-cars-profile
                        :customer="{{$customer}}"
                        :marks="{{$marks}}"
                        :transmissions="{{$transmissions}}"
                        :years="{{$years}}"
                        :lang="{{$lang}}"
                        :mark_models="{{$mark_models}}">
                    </customer-cars-profile>
                </div>
            </div>
        </div>
    </div>
@endsection
