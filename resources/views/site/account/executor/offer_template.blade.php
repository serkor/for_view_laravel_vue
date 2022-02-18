@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.executor.offer_template.title')
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <executor-add-offer-template
                    :executor="{{$executor}}"
                    :lang="{{$lang}}">
                </executor-add-offer-template>
                <hr>
                <div class="card">
                    <executor-get-list-offer-template
                        :executor="{{$executor}}"
                        :lang="{{$lang}}">
                    </executor-get-list-offer-template>
                </div>
            </div>
        </div>
    </div>
@endsection
