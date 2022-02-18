@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning is-halfheight">
        <div class="hero-body">
            <div class="">
                <p class="title">
                    @lang('info.no_access')
                </p>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="hero-body">
            <div class="row box_account">
                @lang('info.no_access_text')
            </div>
        </div>
    </div>
@endsection
