@extends('layouts.site.app')

@section('content')
    <section class="hero">
        <div class="hero-body">
            <p class="title">
                @lang('page.executor.calendar')
            </p>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="hero-body">
                        <calendar-component :reminders="{{$reminders}}"
                                            :lang_service="{{$lang_service}}">
                        </calendar-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
