@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.contacts.title')
                </p>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="hero-body">
            <div class="columns">
                <div class="column is-2">
                    @include('layouts.site.menu.sidebar_site')
                </div>
                <div class="column is-8">
                    <b>@lang('page.contacts.title_form')</b>
                    <hr>
                    <div class="box_account">
                        <div class="col">
                            {!! Form::open(['method' => 'POST', 'route' => 'store_repeat']) !!}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        {!! Form::label('name', trans('page.contacts.name'),['class' => 'control-label'])!!}
                                        {!! Form::text('name', old('name'), array_merge(['class'
                                        =>'form-control','required']))!!}
                                    </div>
                                    <div class="col-6">
                                        {!! Form::label('email', trans('page.contacts.email'),['class' => 'control-label']) !!}
                                        {!! Form::email('email', old('email'), array_merge(['class' =>'form-control']))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', trans('page.contacts.description'),['class' => 'control-label'])!!}
                                {!! Form::textarea('description', old('description'), array_merge(['class' =>'form-control','required'])) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit(trans('page.contacts.send'),array_merge(['class' => 'button is-dark'] )) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="column is-2"></div>
            </div>
        </div>
    </div>
@endsection
