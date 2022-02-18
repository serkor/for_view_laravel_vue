@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.customer.favorites')
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="hero-body">

                        <customer-favorite-catalog
                            :lang="{{$lang}}">
                        </customer-favorite-catalog>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
