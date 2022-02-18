@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.executor.settings')
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="hero-body">
                        <div class="box_account">
                            <div class="columns">
                                <div class="column">
                                    {!! Form::model($executor,['method' => 'PUT', 'route' => ['update_executor_settings', $executor->id ]] )!!}
                                    <div class="custom-control custom-checkbox">
                                        {!! Form::checkbox('get_email', old('get_email'), $executor->get_email) !!}
                                        <label>@lang('executor.get_email')</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        {!! Form::checkbox('show_profile', old('show_profile'), $executor->show_profile) !!}
                                        <label>@lang('executor.show_profile')</label>
                                    </div>
                                    <hr>
                                    <div class="buttons">
                                        <button type="submit" class="button is-dark is-outlined">
                                            @lang('form.update')
                                        </button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                                <div class="column">
                                    {!! Form::model($executor,['method' => 'PUT', 'route' => ['update_user_password', $executor->id ]] )!!}
                                    <div class="card m-3 p-3">
                                        <div class="col mb-3">
                                            <label for="password">@lang('user.password')</label>
                                            {!! Form::password('password', array_merge(['class' =>'form-control', 'autocomplete' => "new-password", 'required'])) !!}
                                        </div>
                                        <div class="col mb-3">
                                            <label for="repeat_password">@lang('user.repeat_password')</label>
                                            {!! Form::password('password_confirmation', array_merge(['class' =>'form-control', 'autocomplete' => "new-password", 'required'])) !!}
                                        </div>
                                        <hr>
                                        <div class="buttons">
                                            <button type="submit" class="button is-dark is-outlined">
                                                @lang('user.update_password')
                                            </button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
