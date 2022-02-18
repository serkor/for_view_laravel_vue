@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.customer.bids')
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <customer-add-bid-profile
                    :customer="{{$customer}}"
                    :cities="{{$cities}}"
                    :categories="{{$categories}}"
                    :lang="{{$lang}}"
                    :cars="{{$cars}}"
                    :marks="{{$marks}}"
                    :transmissions="{{$transmissions}}"
                    :years="{{$years}}"
                    :mark_models="{{$mark_models}}"
                >
                </customer-add-bid-profile>
                <hr>
                <div class="container">
                    <customer-bids-profile
                        :cities="{{$cities}}"
                        :categories="{{$categories}}"
                        :cars="{{$cars}}"
                        :lang="{{$lang}}"
                        :customer="{{$customer}}">
                    </customer-bids-profile>
                </div>
            </div>
        </div>
    </div>
@endsection
