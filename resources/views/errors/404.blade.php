@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning is-halfheight">
        <div class="hero-body">
            <div class="">
                <p class="title">
                   404
                </p>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="hero-body">
            <div class="row box_account">
                @lang('info.404')
            </div>
        </div>
    </div>
@endsection
