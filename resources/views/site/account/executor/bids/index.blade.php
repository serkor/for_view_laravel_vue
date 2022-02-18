@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.executor.bids')
                </p>
            </div>
        </div>
    </section>

    <div class="container is-fluid">
        <executor-bids-profile
            :executor="{{$executor}}"
            :cities="{{$cities}}"
            :categories="{{$categories}}"
            :lang="{{$lang}}">
        </executor-bids-profile>
    </div>
@endsection
