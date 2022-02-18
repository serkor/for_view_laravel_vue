@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('auth.login_title')
                </p>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="hero-body">
            <div class="subtitle text-center">
                @lang('auth.login_subtitle')
            </div>
            <div class="columns">
                <div class="column">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="columns">
                            <div class="column is-3"></div>
                            <div class="column is-6 box">
                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">@lang('auth.email')</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-right">@lang('auth.password')</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                @lang('auth.remember_me')
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="button is-dark">
                                            @lang('auth.login')
                                        </button>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                @lang('auth.forgot_password')
                                            </a>
                                        @endif
                                        <hr>
                                        <div class="columns">
                                            <div class="column">
                                                <a class="button is-light" href="{{ route('register') }}">
                                                    @lang('auth.register_title')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
