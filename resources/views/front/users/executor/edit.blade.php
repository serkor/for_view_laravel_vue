@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bs-example">

                            <h2 class="sub-header">@lang('form.edit') - {{$executor->name}}</h2>

                            <div class="hero-body">
                                <div class="row box_account">
                                    <div class="col-md-12">
                                        {!! Form::model($executor,['method' => 'PUT','files' => true, 'route' => ['update_executor_user', $executor->id ]] )!!}
                                        <div class="row">
                                            <div class="col-md-4 mb-3">

                                                @if($executor->verified())
                                                    <div class="verified_user">
                                                <span class="badge badge-pill badge-success">
                                                    @lang('executor.verified')</span>
                                                    </div>
                                                @endif

                                                @if($executor->image ?? [])
                                                    <img id="blah" class="img-thumbnail logo_user"
                                                         src="{{ asset('storage/avatar/'.$executor->image) }}"
                                                         alt="logo">
                                                @else
                                                    <img id="blah" class="img-thumbnail logo_user"
                                                         src="{{ asset('public/images/user_no.png') }}"
                                                         alt="logo">
                                                @endif
                                            </div>
                                            <div class="col-md-8 mb-3">
                                                <label for="lastName">@lang('executor.general_image')</label>
                                                <input id="file" class="form-control-file" type="file"
                                                       name="image">
                                                <hr>
                                                <div class="alert alert-light" role="alert">
                                                    <a class="button is-dark"
                                                       href="{{route('executor', $executor->id)}}">
                                                        @lang('executor.see_public_profile')</a>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="verified">@lang('executor.verified')</label>
                                                        {!! Form::select('verified', [1 => 'Да', 0 => 'Нет'], old('verified'), array_merge(['class' =>'form-control'])) !!}
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="show_map">@lang('executor.package_id')</label>
                                                        {!! Form::select('package_id', [1 => 'BASE', 2 => 'PRO'], $executor->package_id, array_merge(['class' =>'form-control'])) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="box">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name">@lang('executor.name')</label>
                                                    {!! Form::text('name', old('name'), array_merge(['class' =>'form-control'])) !!}
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="city_id">@lang('executor.city')</label>
                                                    <city-select :cities="{{$cities}}"
                                                                 :city="{{$executor->city}}"></city-select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="phone">@lang('executor.phone')</label>
                                                    {!! Form::number('phone', old('phone'), array_merge(['class' =>'form-control'])) !!}
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="email">@lang('executor.email')</label>
                                                    {!! Form::email('email', old('email'), array_merge(['class' =>'form-control'])) !!}
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label
                                                        for="company_contact">@lang('executor.company_contact')</label>
                                                    {!! Form::text('company_contact', old('company_contact'), array_merge(['class' =>'form-control'])) !!}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-9 mb-3">
                                                    <label for="address">@lang('executor.address')</label>
                                                    {!! Form::text('address', old('address'), array_merge(['class' =>'form-control'])) !!}
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="show_map">@lang('executor.show_map')</label>
                                                    {!! Form::select('show_map', [1 => 'Да', 0 => 'Нет'], old('show_map'), array_merge(['class' =>'form-control'])) !!}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label
                                                        for="description">@lang('executor.description')</label>
                                                    {!! Form::textarea('description', old('description'), array_merge(['class' =>'form-control', 'id' => "editor"])) !!}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-9 mb-3">
                                                    <label for="work_hours">@lang('executor.work_hours')</label>
                                                    {!! Form::text('work_hours', old('work_hours'), array_merge(['class' =>'form-control'])) !!}
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label
                                                        for="year_experience">@lang('executor.year_experience')</label>
                                                    {!! Form::number('year_experience', old('year_experience'), array_merge(['class' =>'form-control'])) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="box">
                                            <b>@lang('executor.data_company')</b>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-9 mb-3">
                                                    <label
                                                        for="company_name">@lang('executor.company_name')</label>
                                                    {!! Form::text('company_name', old('company_name'), array_merge(['class' =>'form-control'])) !!}
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label
                                                        for="company_type">@lang('executor.company_type')</label>
                                                    {!! Form::select('company_type', [0 => 'Юр.лицо', 1 => 'ФЛП'], old('company_type'), array_merge(['class' =>'form-control'])) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label
                                                        for="company_address">@lang('executor.company_address')</label>
                                                    {!! Form::textarea('company_address', old('company_address'), array_merge(['class' =>'form-control', 'rows' => 2])) !!}
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label
                                                        for="company_requisites">@lang('executor.company_requisites')</label>
                                                    {!! Form::textarea('company_requisites', old('company_requisites'), array_merge(['class' =>'form-control', 'rows' => 2])) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3"></div>
                                                <div class="col-md-6 mb-3">
                                                    @foreach($files as $file)
                                                        <div class="bd-example">
                                                            <details>
                                                                <summary>{{$file->name}}</summary>
                                                                <a target="_blank"
                                                                   href="{{ asset('/storage/files/'.$file->url) }}">
                                                                    @lang('user.files_download')
                                                                </a>
                                                            </details>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="box">
                                            <b>@lang('executor.category')</b>
                                            <hr>
                                            <categories-profile
                                                :executor="{{$executor}}"
                                                :categories="{{$categories}}"
                                                :executor_categories="{{$executor_categories}}">
                                            </categories-profile>
                                        </div>

                                        <div class="box">
                                            <b>@lang('executor.type_pay')</b>
                                            <hr>
                                            <payment-types-profile
                                                :payment_types="{{$payment_types}}"
                                                :executor_payment_types="{{$executor_payment_types}}">
                                            </payment-types-profile>
                                        </div>

                                        <div class="box">
                                            <b>@lang('executor.dop')</b>
                                            <hr>
                                            <additional-services-profile
                                                :executor_additional_services="{{$executor_additional_services}}"
                                                :additional_services="{{$additional_services}}">
                                            </additional-services-profile>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                {!! Form::submit(trans('form.update'), array_merge(['class' => 'btn btn-primary btn-block'] )) !!}
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
            @section('js')
                <script
                    src="https://cdn.tiny.cloud/1/12u8g1xa8taurft5j61jmfr6rvn9p5xbtm24xg660tbz7s7n/tinymce/5/tinymce.min.js"
                    referrerpolicy="origin"></script>
                <script>
                    tinymce.init({
                        selector: '#editor'
                    });
                </script>
@endsection
