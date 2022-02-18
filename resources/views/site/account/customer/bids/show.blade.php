@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.customer.bid') №{{$bid->id}}
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <customer-bid-profile
                    :bid="{{$bid}}"
                    :lang="{{$lang}}"
                    :files="{{$files}}"
                    :all_statuses="{{$statuses}}">
                </customer-bid-profile>
            </div>
        </div>
    </div>
@endsection



