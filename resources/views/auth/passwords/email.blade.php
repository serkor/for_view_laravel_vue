@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('auth.reset_password_title')
                </p>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="hero-body">

            <div class="subtitle text-center">
                @lang('auth.reset_password_subtitle')
            </div>


            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="columns">
                    <div class="column is-3"></div>
                    <div class="column box is-6">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('auth.email')</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <div class="buttons">
                                    <button type="submit" class="button is-dark">
                                        @lang('auth.send_password_reset_link')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3"></div>
                </div>

            </form>
        </div>
    </div>
@endsection
