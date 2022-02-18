@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.executor.bid') №{{$bid->id}}
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <executor-bid-profile
                    :bid="{{$bid}}"
                    :files="{{$files}}"
                    :lang="{{$lang}}"
                    :all_statuses="{{$statuses}}"
                    :offer_templates="{{$offer_templates}}"
                    :executor="{{$executor}}">
                </executor-bid-profile>
            </div>
        </div>
    </div>
@endsection



