@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.customer.profile')
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
                            <div class="col-md-12">
                                {!! Form::model($customer,['method' => 'PUT','files' => true, 'route' => ['update_customer_account', $customer->id ]] )!!}
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        @if($customer->image ?? [])
                                            <img id="blah" class="img-thumbnail logo_user"
                                                 src="{{ asset('storage/avatar/'.$customer->image) }}" alt="logo">
                                        @else
                                            <img id="blah" class="img-thumbnail logo_user"
                                                 src="{{ asset('public/images/user_no.png') }}" alt="logo">
                                        @endif
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <b-field label="@lang('executor.general_image')">
                                            <b-field class="file is-dark">
                                                <b-upload class="file-label" rounded>
                                                    <input id="file" class="form-control-file" type="file" name="image">
                                                    <span class="file-cta">
                                                    <b-icon class="file-icon" icon="upload"></b-icon>
                                                       <span class="file-label">@lang('form.download')</span>
                                                  </span>
                                                </b-upload>
                                            </b-field>
                                        </b-field>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName">@lang('user.name')</label>
                                        {!! Form::text('name', old('name'), array_merge(['class' =>'form-control'])) !!}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName">@lang('user.surname')</label>
                                        {!! Form::text('surname', old('surname'), array_merge(['class' =>'form-control'])) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone">@lang('user.phone')</label>
                                        {!! Form::text('phone', old('phone'), array_merge(['class' =>'form-control', 'placeholder'=> "380#########",  'maxlength'=>"12"])) !!}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">@lang('user.email')</label>
                                        {!! Form::email('email', old('email'), array_merge(['class' =>'form-control'])) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="buttons">
                                            <button type="submit" class="button is-dark">
                                                @lang('form.update')
                                            </button>
                                        </div>
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
@endsection
